<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;


class RatingController extends Controller
{
    public function showPrompt(Order $order)
{
    return view('prompt', compact('order'));
}

public function create(Order $order)
{
    return view('form', compact('order'));
}

public function store(Request $request, Order $order)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'nullable|string',
    ]);

    Rating::create([
        'seller_id' => $order->product->student_id,
        'buyer_id' => auth()->id(),
        'order_id' => $order->id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return redirect()->route('marketplace')->with('success', 'Thank you for your feedback!');
}

}
