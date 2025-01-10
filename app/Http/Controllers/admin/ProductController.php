<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SellingZone;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    public function create(){
        $zones = SellingZone::latest()->get();
        return view('admin.product.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'zone_id' => 'required|exists:selling_zones,id',
            'description' => 'nullable|string'
        ]);

        try{
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'selling_zone_id' => $request->zone_id,
                'description' => $request->description,
                'stock' => 0
            ]);
            return redirect()->route('admin.product.index')->with('success', 'Product has created!');
        }catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $zones = SellingZone::latest()->get();
        return view('admin.product.edit', compact('product', 'zones'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'zone_id' => 'required|exists:selling_zones,id',
            'description' => 'nullable|string'
        ]);

        try{
            $product = Product::findOrFail($request->id);
            $product->update([
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'selling_zone_id' => $request->zone_id,
                'description' => $request->description
            ]);
            return redirect()->route('admin.product.index')->with('success', 'Product has updated!');
        }catch(Exception $e){
            dd($e);
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function zones()
    {
        $zones = SellingZone::latest()->get();
        return view('admin.product.zone', compact('zones'));
    }

    public function zone_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:12'
        ]);

        try{
            SellingZone::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
            return redirect()->route('admin.zone.index')->with('success', 'Zone has created!');
        }catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }
}
