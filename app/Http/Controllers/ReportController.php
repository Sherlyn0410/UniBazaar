<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function createReport(Order $order, Request $request)
    {
        $index = $request->query('index', null);
        return view('report-form', compact('order', 'index'));
    }

    public function storeReport(Request $request, Order $order)
    {
        $request->validate([
            'reason' => 'required',
        ]);

        Report::create([
            'buyer_id' => auth()->id(),
            'seller_id' => $order->product->student_id,
            'order_id' => $order->id,
            'reason' => $request->reason,
        ]);
        return redirect()->route('profile', ['tab' => 'order'])->with('success', 'Seller report submitted successfully.');
    }
}

