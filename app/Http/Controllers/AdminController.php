<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Product;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewStudent(){
           $students = Student::all();
        return view('view-student',['students' => $students]);
    }


       public function viewProduct(){
$products = Product::with('student')->get();
        return view('view-product',['products' => $products]);
    }
}

