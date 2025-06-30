<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductApproved;
use App\Mail\ProductRejected;
use App\Models\Student;
use App\Models\Product;
use App\Models\Order;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewStudent(){
           $students = Student::all();
        return view('view-student',['students' => $students]);
    }

    public function viewAdmin(){
        return view('admin');
    }

       public function viewProduct(){
        $products = Product::with('student')->get();
        return view('view-product',['products' => $products]);
       }

       public function viewOrder(){
        $orders = Order::with(['buyer', 'product'])->latest()->get();
        return view('view-order', compact('orders'));
    }

public function pending()
{
    // Show only products with status 'pending'
    $products = Product::where('status', 'pending')->with('student')->get();
    return view('pending', compact('products'));
}

public function approve(Product $product)
{
   $status = $product->quantity > 0 ? 'live' : 'out_of_stock';

    $product->update([
        'is_approved' => true,
        'status' => $status,
    ]);

    Mail::to($product->student->email)->send(new ProductApproved($product));

    return back()->with('success', 'Product approved and email sent.');

    return back()->with('success', 'Product approved and email sent.');
}

public function reject(Product $product)
{
    // Send rejection email before deleting
    Mail::to($product->student->email)->send(new ProductRejected($product));

    // Delete the product entirely
    $product->delete();

    return back()->with('success', 'Product rejected, deleted and email sent.');
}
    }


