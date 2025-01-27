<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product/index_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product/create_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_product(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'stock' => 'required',
        ]);

        $file = $request->file('image');

        $originalPath = time().'_'.$request->name.'-'.$file->getClientOriginalName();
        $hashedPath = hash('sha256', $originalPath);
        Storage::disk('public')->put($hashedPath, file_get_contents($file));




        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $hashedPath,
            'stock' => $request->stock,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
        
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('product/show_product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('product/edit_product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            //make image not required
            'image' => '',
            'stock' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;

        if($request->file('image')){
            $file = $request->file('image');
            $originalPath = time().'_'.$request->name.'-'.$file->getClientOriginalName();
            $hashedPath = hash('sha256', $originalPath);
            Storage::disk('public')->put($hashedPath, file_get_contents($file));
            $product->image = $hashedPath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
