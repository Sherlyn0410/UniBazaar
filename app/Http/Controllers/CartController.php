<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart()
    {
    $studentId = Auth::id();
    $cartItems = Cart::with('product') // eager load product info
                     ->where('student_id', $studentId)
                     ->get();

    return view('cart', compact('cartItems'));
  }


public function addToCart(Request $request)
{

    $product = Product::findOrFail($request->product_id);
    $requestedQuantity = (int) $request->quantity;

    if ($requestedQuantity > $product->quantity) {
        return back()->with('error', 'Requested quantity exceeds available stock.');
    }
    
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $student_id = Auth::id();

    $cartItem = Cart::where('student_id', $student_id)
                    ->where('product_id', $request->product_id)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
    } else {
        Cart::create([
            'student_id' => $student_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
    }

    return redirect()->back()->with('success', 'Item added to cart.');
}

public function removeFromCart($id)
{
    $cartItem = Cart::findOrFail($id);

    // Optional: make sure the logged-in user owns the cart item
    if ($cartItem->student_id != Auth::id()) {
        abort(403);
    }

    $cartItem->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}
}

