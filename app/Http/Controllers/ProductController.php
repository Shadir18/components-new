<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\json;

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
            return response()->json([
                'success' => false,
                'message' => 'You must be an seller to post products'
            ], 403);
        }
        try {
            DB::beginTransaction();
            $attributes['seller_id'] = $seller->id;
            $product = Product::create($attributes);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product listing posted successfully!',
                'data' => $product
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product'
            ], 500);
        }
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
        try {
            DB::beginTransaction();
            $product->update($attributes);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
                'product' => $product,
                'redirect_url' => '/products/' . $product->id
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create product'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return response()->json([
                'success' => true, 
                'message' => 'delete success',
                'redirect_url' => '/products'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Failed to delete'
            ], 500);
        }
    }
}