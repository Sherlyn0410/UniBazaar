<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function createProducts()
    {
        return view('product-upload');
    }

   public function storeProducts(Request $request)
{
    $student = Auth::user();

    if (!$student) {
        return redirect()->route('login')->with('error', 'Please log in as a student.');
    }

    $data = $request->validate([
        'product_name' => 'required',
        'category' => 'required',
        'product_price' => 'required|numeric',
        'quantity' => 'required|integer',
        'product_details' => 'required',
        'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/img'), $imageName);
        $data['product_image'] = $imageName; // ✅ store only the filename
    }

    $data['student_id'] = $student->id;
    $data['is_approved'] = false;
    $data['status'] = 'pending';

    Product::create($data);

    return redirect(route('main'))->with('status', 'Your product has been submitted and is pending admin approval.');
}

}
