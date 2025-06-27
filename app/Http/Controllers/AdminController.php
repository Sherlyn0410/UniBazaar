<?php

namespace App\Http\Controllers;
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
    }


