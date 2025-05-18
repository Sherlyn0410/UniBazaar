<?php

namespace App\Http\Controllers;

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
        $data = $request ->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_details' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/img'), $imageName);
            $data['product_image'] = 'assets/img/' . $imageName;
        }
        //store to db
        $newproduct = Product::create($data);
        return redirect(route('/'));
    }
}
