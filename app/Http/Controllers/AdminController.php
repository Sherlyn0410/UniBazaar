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
        $products = Product::where('is_approved', false)->with('student')->get();
        return view('pending', compact('products'));
    }

        public function approve(Product $product)
        {

           $product->update(['is_approved' => true]);

            Mail::to($product->student->email)->send(new ProductApproved($product));

            return back()->with('success', 'Product approved and email sent.');
        }

        public function reject(Product $product)
        {
                $product->update(['is_approved' => false]); // or delete if you prefer

                Mail::to($product->student->email)->send(new ProductRejected($product));
                    $product->delete();


                return back()->with('success', 'Product rejected and email sent.');
        }
    }


