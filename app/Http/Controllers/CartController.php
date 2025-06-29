<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // View cart page
    public function viewCart()
    {
        $studentId = Auth::id();
        $cartItems = Cart::with('product')
                         ->where('student_id', $studentId)
                         ->get();

        return view('cart', compact('cartItems'));
    }

    // Add item to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $requestedQuantity = (int) $request->quantity;

        if ($requestedQuantity > $product->quantity) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $student_id = Auth::id();

        $cartItem = Cart::where('student_id', $student_id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $requestedQuantity;
            $cartItem->save();
        } else {
            Cart::create([
                'student_id' => $student_id,
                'product_id' => $request->product_id,
                'quantity'   => $requestedQuantity,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    // Remove item from cart
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->student_id != Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    // Checkout selected items
    public function checkoutCart(Request $request)
    {
        $selectedIds = $request->query('selected_items');

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'Please select at least one item to checkout.');
        }

        $cartItems = Cart::with('product')
            ->where('student_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        return view('cart-checkout', compact('cartItems'));
    }

    // Update quantity
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::with('product')->findOrFail($id);

        if ($cartItem->student_id != Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($cartItem->product->quantity < $validated['quantity']) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();

        return back()->with('success', 'Quantity updated.');
    }
}





