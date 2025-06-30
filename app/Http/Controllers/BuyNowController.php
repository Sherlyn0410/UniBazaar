<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class BuyNowController extends Controller
{
    public function show(Product $product)
    {
        return view('buy-now', compact('product'));
    }

    public function placeOrder(Request $request)
{
    request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'payment_method' => 'required|in:stripe,pay_in_person',
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($request->quantity > $product->quantity) {
        return back()->with('error', 'Requested quantity exceeds stock.');
    }

    $amount = $product->product_price * $request->quantity;
    $isPaid = false;

    if ($request->payment_method === 'stripe') {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $amount * 100, // in cents
                'currency' => 'myr',
                'description' => 'Buy Now - Product ID ' . $product->id,
                'source' => $request->stripeToken,
            ]);

            $isPaid = true;
        } catch (\Exception $e) {
            return back()->with('error', 'Stripe error: ' . $e->getMessage());
        }
    }

    // Create order
    Order::create([
        'student_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => $request->quantity,
        'is_paid' => $isPaid,
    ]);

    // Decrement product stock
    $product->decrement('quantity', $request->quantity);

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}
}
