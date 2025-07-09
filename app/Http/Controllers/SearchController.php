<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
   public function autocomplete(Request $request)
{
    $query = $request->get('query');

    $products = Product::where('name', 'like', "%{$query}%")
                       ->get(['id', 'name']); // return both id and name

    return response()->json($products);
}

}
