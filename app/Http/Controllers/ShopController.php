<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

<<<<<<< HEAD
  public function show($id)
{
    $product = Product::with('images')->findOrFail($id);
    return view('shop.show', compact('product'));
}

=======
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
   public function liveSearch(Request $request)
{
    $query = $request->get('query');

    $products = Product::where('name', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->get();

    return view('partials.product-cards', compact('products'))->render();
}
<<<<<<< HEAD

public function adminIndex()
{
    // You can customize this logic
    $products = \App\Models\Product::all(); // make sure Product model exists

    return view('shop.admin', compact('products'));
}

=======
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
}
