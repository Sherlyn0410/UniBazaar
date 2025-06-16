<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // SHOW the checkout page
    public function show()
    {
        $cartItems = Cart::with('product')->where('student_id', auth()->id())->get();
        return view('checkout', compact('cartItems'));
    }

    // HANDLE placing the order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Example: Save order data to database (you can create Order model/table)
        // Order::create([...]);

        // Clear the cart
        Cart::where('student_id', auth()->id())->delete();

        return redirect()->route('main')->with('status', 'Order placed successfully!');
    }
}

