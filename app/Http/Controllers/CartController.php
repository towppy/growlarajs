<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        // ADD PRODUCT TO CART (using session)
        $cart = session()->get('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Added to cart!');
    }

    public function view()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }
}
