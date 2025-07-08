<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            return view('dashboard', ['isAdmin' => true]);
        } else {
            $products = Product::all();
            return view('dashboard', [
                'isAdmin' => false,
                'products' => $products
            ]);
        }
    }
}
