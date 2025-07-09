<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display all products on the shop index page.
     */
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    /**
     * Show a single product with its images (if images relationship is defined).
     */
   public function show($id)
{
    $product = Product::findOrFail($id); // ✅ No 'images' relationship
    return view('shop.show', compact('product'));
}


    /**
     * Perform live search on product name or description.
     */
  public function liveSearch(Request $request)
{
    $query = $request->get('query');

    $products = Product::where('name', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->get();

    return view('product-cards', compact('products'))->render();
}

    /**
     * Display all products on the admin shop page.
     */
    public function adminIndex()
    {
        $products = Product::all();
        return view('shop.admin', compact('products'));
    }
}
