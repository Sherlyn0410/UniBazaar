<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Product;
use App\Models\Order;



class ProfileController extends Controller
{
    public function viewProfile()
    {
        // Retrieve the currently authenticated student
        $student = Auth::guard('web')->user(); // 'web' guard uses 'students' provider if set in config/auth.php
        $products = Product::all(); // Get all products from the database or any other source
        $orders = Order::with(['buyer', 'product'])->latest()->get();

        return view('profile', compact('student', 'products', 'orders'));
    }

    public function update(Student $student, Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $student = Auth::guard('web')->user();

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($student->profile_image && Storage::exists('public/profile_images/' . $student->profile_image)) {
                Storage::delete('public/profile_images/' . $student->profile_image);
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile_images', $imageName);
            $student->profile_image = $imageName;
        }

        $student->update($data);



        return redirect()->route('profile')->with('status', 'Profile updated successfully!');
    }


    public function editProduct(Product $product)
    {

    return view('product-edit', compact('product'));

    }

public function updateProduct(Request $request, Product $product)
{
    $data = $request->validate([
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('product_image')) {
        if ($product->product_image && Storage::exists('public/product_images/' . $product->product_image)) {
            Storage::delete('public/product_images/' . $product->product_image);
        }

        $imageName = time() . '.' . $request->file('product_image')->extension();
        $request->file('product_image')->storeAs('public/product_images', $imageName);
        $product->product_image = $imageName;
    }

    $product->update([
        'product_name' => $data['product_name'],
        'product_price' => $data['product_price'],
    ]);

    return redirect()->route('profile')->with('status', 'Product updated successfully!');
}
}
