<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyNowController extends Controller
{
    public function show(Product $product)
    {
        return view('buy-now', compact('product'));
    }

    public function placeOrder(Request $request)
    {
        // You can add validation here
        Order::create([
            'student_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => 1,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

        return redirect()->route('marketplace')->with('success', 'Order placed successfully!');
    }
}
