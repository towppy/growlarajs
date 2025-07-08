<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products (admin view)
    public function index()
    {
        $products = Product::all();
        return view('crud-admin.prod-management', compact('products'));
    }

    // Show form to add product
    public function create()
    {
        return view('crud-admin.add');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect()->route('prod.management')->with('success', 'Product created successfully!');
    }

    // Show form to edit product
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('crud-admin.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'delete_images' => 'array',
            'delete_images.*' => 'integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'price', 'stock']));

        // ✅ Delete selected images
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::where('product_id', $product->id)->find($imageId);
                if ($image) {
                    $path = public_path('uploads/products/' . $image->filename);
                    if (file_exists($path)) unlink($path);
                    $image->delete();
                }
            }
        }

        // ✅ Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'filename' => $filename
                ]);
            }
        }

        return redirect()->route('prod.management')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete all related images from DB and storage
        foreach ($product->images as $image) {
            $path = public_path('uploads/products/' . $image->filename);
            if (file_exists($path)) unlink($path);
            $image->delete();
        }

        $product->delete();

        return redirect()->route('prod.management')->with('success', 'Product deleted successfully!');
    }
}
