<?php

namespace App\Http\Controllers;
Use App\Http\Controllers\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderConfirmation;

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

    public function checkout(Product $product)
{
    return view('checkout', compact('product'));
}


public function charge(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $product = Product::findOrFail($request->product_id);
    $quantity = (int) $request->quantity;
    $total = $product->product_price * $quantity;

    try {
        $charge = Charge::create([
            'amount' => $total * 100, // Stripe expects cents
            'currency' => 'myr',
            'source' => $request->stripeToken,
            'description' => 'Payment for ' . $product->product_name,
        ]);

        // ✅ Save order in database
        Order::create([
            'buyer_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'ordered_at' => now(),
            'payment_method' => 'Stripe',
            'stripe_payment_id' => $charge->id,
            'is_paid' => true,
        ]);

        // ✅ Reduce product stock
        $product->quantity -= $quantity;
        $product->save();

        return redirect()->route('marketplace')->with('success', 'Payment successful and order placed!');
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}


 public function processCartPayment(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $charge = Charge::create([
            'amount' => $request->total * 100,
            'currency' => 'myr',
            'source' => $request->stripeToken,
            'description' => 'Cart Payment by User ID: ' . auth()->id(),
        ]);

        foreach ($request->cart_items as $itemId => $data) {
    $product = Product::find($data['product_id']);
    if (!$product) continue;

    // ✅ Save order and store in variable
    $order = Order::create([
        'buyer_id' => auth()->id(),
        'product_id' => $data['product_id'],
        'quantity' => $data['quantity'],
        'ordered_at' => now(),
        'payment_method' => 'Stripe',
        'stripe_payment_id' => $charge->id,
        'is_paid' => true,
    ]);


    // ✅ Update product stock
    $product->quantity -= $data['quantity'];
    $product->save();

    // ✅ Remove from cart
    Cart::destroy($itemId);
}

    // ✅ Send confirmation email
    $order->load('buyer', 'product');
   try {
    Mail::to(auth()->user()->email)->send(new OrderConfirmation($order));
} catch (\Exception $e) {
    dd("Email failed: " . $e->getMessage());
}
return redirect()->route('rate.seller.prompt', $order->id);
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}
}

