<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function viewMain()
    {
        $products = Product::all(); // Get all products from the database or any other source
        return view('main', compact('products'));
    }

    public function viewMarketplace()
    {
        $products = Product::all(); // Get all products from the database or any other source
        return view('marketplace', compact('products'));
    }

    public function viewProductDetails($id)
    {
        $product = Product::with('student')->findOrFail($id); // Load the product and related student info
        return view('product-details', compact('product'));
    }
}
