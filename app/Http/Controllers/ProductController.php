<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->simplePaginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'price' => ['required']
        ]);
        $seller = Auth::user()->seller;
        if (! $seller) {
            abort(403, 'You must be an seller to post products');
        }
        $attributes['seller_id'] = $seller->id;
        Product::create($attributes);
        return response()->json([
            'message' => 'Product listing posted successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:5'],
            'company' => ['required'],
            'price' => ['required']
        ]);

        $product->update($attributes);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!',
            'product' => $product,
            'redirect_url' => '/products/' . $product->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!',
            'redirect_url' => '/products'
        ], 200);
    }
}
