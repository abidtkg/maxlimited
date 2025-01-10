<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purcahses = Purchase::orderBy('id', 'desc')->paginate(50);
        return view('admin.purchase.index', compact('purcahses'));
    }

    public function create()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.purchase.create', compact('products'));
    }

    public function show($id)
    {
        $purchase = Purchase::find($id);
        // return $purchase->products;
        return view('admin.purchase.show', compact('purchase'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        // Calculate the total amount for the purchase
        $products = [];
        $totalPurchaseAmount = 0;
        foreach($request->products as $product_raw) {
            // Split the string using the dash (-) as the delimiter
            list($product_id, $qty) = explode('-', $product_raw);
            
            $product = Product::find($product_id);
            array_push($products, [
                'product_id' => $product->id,
                'quantity' => $qty,
                'total' => $product->price * $qty,
            ]);
            $totalPurchaseAmount += $product->price * $qty;

            // Update the product quantity
            $product->increment('stock', $qty);
        }
        
        // Create a new purchase record
        $purchase = Purchase::create([
            'total' => $totalPurchaseAmount,
        ]);
    
        // Insert product details into the purchase_products table
        foreach($products as $product) {
            PurchaseProduct::create([
                'purchase_id' => $purchase->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'total' => $product['total'],
            ]);
        }
        return redirect()->route('admin.purchase.index')->with('success', 'Purchase recorded successfully!');
    }
}
