<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class MainController extends Controller
{
   public function viewMain()
{
    $products = Product::with('student.receivedRatings') // eager load seller ratings
        ->where('status', 'live')
        ->where('quantity', '>', 0)
        ->latest()
        ->get();

 
    return view('main', compact('products'));
}


   public function viewMarketplace(Request $request)
{
    $query = $request->input('query');

    $results = collect(); // default empty if no query
    if ($query) {
        $results = Product::where('product_name', 'LIKE', "%{$query}%")
            ->where('status', 'live')
            ->where('quantity', '>', 0)
            ->where('is_approved', 1)
            ->get();
    }

    $products = Product::where('status', 'live')
        ->where('quantity', '>', 0)
        ->where('is_approved', 1)
        ->get();

    return view('marketplace', compact('products', 'results', 'query'));
}

public function filterByCategory($category)
{
    $products = Product::where('category', $category)
        ->where('is_approved', 1)
        ->where('quantity', '>', 0)
        ->get();

    return view('marketplace', [
        'products' => $products,
        'results' => collect(),  // empty search results
        'query' => null           // no search
    ]);
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
