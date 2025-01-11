<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function dashboard()
    {
        // Get the current user
        $user = auth()->user();
        
        // Calculate the total order amount for the current month
        $total_order_current_month = Order::where('user_id', $user->id)
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('payable'); // Assuming `amount` is the column storing the order total
        
        // Calculate the total order amount for the last month
        $total_order_last_month = Order::where('user_id', $user->id)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)
        ->whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->sum('payable');
        
        // Calculate the total order amount for the year to date
        $total_order_year = Order::where('user_id', $user->id)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('payable');
        return view('client.dashboard', compact('total_order_current_month', 'total_order_last_month', 'total_order_year'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(20);
        return view('client.order.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('selling_zone_id', auth()->user()->zone_id)->orderBy('created_at', 'DESC')->get();
        return view('client.order.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1', // Ensure at least one product is selected
            'total_product_price' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'transaction_fee' => 'required|numeric',
            'payable' => 'required|numeric',
            'payment_method' => 'required|string'
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
            'user_id' => auth()->user()->id,
            'total_product_price' => $request->total_product_price,
            'delivery_fee' => $request->delivery_fee,
            'discount' => 0,
            'payable' => $total_order_amount - $request->transaction_fee - $request->discount ?? 0,
            'due' => $total_order_amount - $request->discount ?? 0,
            'payment_mode' => $request->payment_method,
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

        // SEND MESSAGE TO TELETGRAM
        $URL = 'https://api.telegram.org/bot'. env('TELEGRAM_API_KEY') .'/sendMessage?parse_mode=HTML';

        $headers = [
            'Content-Type' => 'application/json',
            'accept' => 'application/json'
        ];
        $message = "Card order from " . auth()->user()->name . "\nOrder ID: " . $order->id . "\nTotal Amount: " . $order->payable . "\nPayment: " . $order->payment_mode;
        $body = [
            'chat_id' => '-1002287595455',
            'text' => $message
        ];

        Http::withHeaders($headers)->post($URL, $body);

        // PROCESS TO GATEWAY IF BKASH
        if($request->payment_method == 'bkash') {
            return redirect()->to(env('APP_URL') . '/bkash/pay/' . $order->id);
        }
        return redirect()->route('client.order.index')->with('success', 'Order created successfully!');
    }

    public function view($id)
    {
        $order = Order::where('user_id', auth()->user()->id)->find($id);
        return view('client.order.view', compact('order'));
    }
}