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
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'address' => 'required|string|max:255',
        'payment_method' => 'required|in:COD,Online',
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($request->quantity > $product->quantity) {
        return back()->with('error', 'Not enough stock available.');
    }

    Order::create([
        'buyer_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => $request->quantity,
        'ordered_at' => now(),
        // you can extend with address and payment_method columns if needed
    ]);

    // Optional: reduce stock
    $product->quantity -= $request->quantity;
    $product->save();

    return redirect()->route('marketplace')->with('success', 'Order placed successfully!');
}
}
