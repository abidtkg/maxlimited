<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()
        ->when(request('user_id'), fn($query) => $query->where('user_id', request('user_id')))
        ->when(request('start_date'), fn($query) => $query->where('created_at', '>=', request('start_date')))
        ->when(request('end_date'), fn($query) => $query->where('created_at', '<=', request('end_date')))
        ->paginate(20);  // Or any number of records per page

        $users = User::where('user_type', 'client')->get();
        return view('admin.order.index', compact('orders', 'users'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function print($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.invoice-print', compact('order'));
    }

    public function done($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'done']);
        return back()->with('success', 'Order status updated to done!');
    }

    public function create()
    {
        $users = User::where('user_type', 'client')->get();
        $products = Product::latest()->get();
        return view('admin.order.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array|min:1', // Ensure at least one product is selected
            'total_product_price' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'payable' => 'required|numeric',
        ]);

        // CHECK THE PRDODCCUT STOCK
        $total_order_amount = $request->delivery_fee;
        $cart_products = [];
        foreach ($request->products as $product_raw) {
            // Split the string into product_id and quantity
            list($product_id, $qty) = explode('-', $product_raw);
            $qty = intval($qty);
            
            // Fetch the product from the database
            $product = Product::find($product_id);
            if ($product) {
                // Calculate the total amount for the product
                $productTotal = $product->price * $qty;
                $total_order_amount += $productTotal;

                // IF PRODUCT IS OUT OF STOCK BREAK THE LOOP AND RETUN ERRR 
                if ($product->stock < $qty) {
                    return back()->with('error', 'Product is out of stock!');
                }

                array_push($cart_products, [
                    'id' => $product->id,
                    'quantity' => $qty,
                    'total' => $productTotal,
                ]);
            }
        }

        // CREATE THE ORDER
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_product_price' => $request->total_product_price,
            'delivery_fee' => $request->delivery_fee,
            'discount' => $request->discount ?? 0,
            'payable' => $total_order_amount - $request->discount ?? 0,
            'due' => $total_order_amount - $request->discount ?? 0,
            'rider_id' => null,
            'payment_mode' => 'cash',
            'status' => 'pending',  // Set default status
            'payment_method' => $request->payment_method ?? 'N/A',  // Add default or based on the request
            'note' => $request->note ?? NULL,  // Add an optional note field
        ]);

        // UPDATE THE PRODUCT STOCK AND INSERT INTO THE PIVOT TABLE

        foreach($cart_products as $cart_product) {
           // Update the product stock
           $product = Product::find($cart_product['id']);
           $product->decrement('stock', $cart_product['quantity']);

           // Insert into the purchase_products table (pivot table)
           OrderProduct::create([
               'order_id' => $order->id,
               'product_id' => $product->id,
               'quantity' => $cart_product['quantity'],
               'total' => $cart_product['total'],
           ]);
        }

        return redirect()->route('admin.order.index')->with('success', 'Order created successfully!');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);

        // RESTOCK THE product
        foreach($order->products as $product) {
            $product->product->increment('stock', $product->quantity);
        }

        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Order deleted successfully!');
    }

    public function add_transaction(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'gateway' => 'required|string',
            'amount' => 'required|numeric',
            'transaction_id' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $order = Order::find($request->order_id);
        $order->update(['due' => $order->due - $request->amount]);
        try{
            OrderTransaction::create([
                'order_id' => $request->order_id,
                'amount' => $request->amount,
                'gateway' => $request->gateway,
                'transaction_id' => $request->transaction_id,
                'note' => $request->note,
            ]);
            return back()->with('success', 'Transaction added successfully!');
        }catch(Exception $e){
            dd($e);
            return back()->with('error', 'An error occurred while adding transaction!');
        }
    }
}
