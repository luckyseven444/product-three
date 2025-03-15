<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
   /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Update the product
        $product->update($validated);

        // Return updated product with ID explicitly
        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product->fresh(), // Ensure fresh data is returned
        ]);
    }


/**
 * Remove the specified resource from storage.
 */
public function destroy(Product $product)
{
    // Delete the product
    $product->delete();

    // Return a success response
    return response()->json([
        'message' => 'Product deleted successfully',
        'id' => $product->id
    ]);
}

}
