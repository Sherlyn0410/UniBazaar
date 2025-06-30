<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Product;
use App\Models\Order;



class ProfileController extends Controller
{
   public function viewProfile()
{
    $student = Auth::guard('web')->user();

    $student->load(['receivedRatings.buyer']); // Load reviews with buyer details

    $products = Product::where('student_id', Auth::id())->with('student')->get();//Only display logged in user
    $orders = Order::with(['buyer', 'product'])
    ->where('buyer_id', auth()->id()) // ✅ Only orders for logged-in user
    ->latest()
    ->get();
    $totalMoney = Order::where('is_paid', true)
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select(DB::raw('SUM(orders.quantity * products.product_price) as total'))
        ->value('total');

    $totalSold = Order::where('is_paid', true)->sum('quantity');

    return view('profile', compact('student', 'products', 'orders', 'totalMoney', 'totalSold'));
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
        'quantity' => 'required|numeric',
        'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($request->hasFile('product_image')) {
        // Delete old image if exists
        if ($product->product_image && Storage::exists('public/assets/img/' . $product->product_image)) {
            Storage::delete('public/assets/img/' . $product->product_image);
        }

        // Store new image
        $imageName = time() . '.' . $request->file('product_image')->extension();
        $request->file('product_image')->storeAs('public/assets/img', $imageName);
        $product->product_image = $imageName;
    }

    // Update product info
    $product->update([
        'product_name' => $data['product_name'],
        'product_price' => $data['product_price'],
        'quantity' => $data['quantity'],
        'product_image' => $product->product_image, // Add this to save new image if any
    ]);

    return redirect()->route('profile')->with('status', 'Product updated successfully!');
}
}
