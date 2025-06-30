<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function viewMain()
    {
        $products = Product::all(); // Get all products from the database or any other source
 $products = Product::where('status', 'live')
                       ->where('quantity', '>', 0)
                       ->get();        return view('main', compact('products'));
    }

    public function viewMarketplace(Request $request)
    {
        $products = Product::all(); // Get all products from the database or any other source
        $query = $request->input('query');

    $results = Product::where('product_name', 'LIKE', "%{$query}%")->get();
$products = Product::where('status', 'live')
                       ->where('quantity', '>', 0)
                       ->get();

        return view('marketplace', compact('products', 'results', 'query'));
    }

    public function viewProductDetails($id)
    {
        $product = Product::with('student')->findOrFail($id); // Load the product and related student info
        return view('product-details', compact('product'));
    }

//     public function search(Request $request)
// {
//     $query = $request->input('query');

//     $results = Product::where('product_name', 'LIKE', "%{$query}%")->get();

//     return view('result', compact('results', 'query'));
// }



}
