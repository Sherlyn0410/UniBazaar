<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;
use App\Mail\ProductApproved;
use App\Mail\ProductRejected;
use App\Mail\StudentBanned;
use App\Models\Student;
use App\Models\Product;
use App\Models\Order;
use App\Models\Report;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewStudent(){
        $students = Student::all();
        $students = Student::where('is_admin', '!=', 1)->get();
        return view('view-student',['students' => $students]);
    }

    public function viewAdmin(){
        return view('admin');
    }

    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('admin-edit-student ', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'contact'  => 'nullable|string|max:20',
        ]);

            $student->name = $data['name'];
            $student->email = $data['email'];
            $student->contact = $data['contact'] ?? $student->contact;

          

            $student->save();

            return redirect()->route('view.student')->with('success', 'Student updated successfully.');
            }

 public function deleteStudent($id)
{
    $student = Student::findOrFail($id);

    // Send the email before deleting
    Mail::to($student->email)->send(new StudentBanned($student));

    // Delete all products created by this student
    Product::where('student_id', $student->id)->delete();

    // Delete the student
    $student->delete();

    return redirect()->route('view.student')->with('status', 'Student and all their products deleted. Email notification sent.');
}

       public function viewProduct()
{
    // Auto-update stock status
    $allProducts = Product::with('student')->get();

    foreach ($allProducts as $product) {
        if ($product->quantity <= 0 && $product->status !== 'out_of_stock') {
            $product->status = 'out_of_stock';
            $product->save();
        } elseif ($product->quantity > 0 && $product->status === 'out_of_stock') {
            $product->status = 'live'; // Optional: revert if restocked
            $product->save();
        }
    }

    // Separate into approved and pending
    $pendingProducts = $allProducts->where('is_approved', 0);
    $approvedProducts = $allProducts->where('is_approved', 1);

    return view('view-product', compact('pendingProducts', 'approvedProducts'));
}


    public function viewOrder(){
        $orders = Order::with(['buyer', 'product'])->latest()->get();
        return view('view-order', compact('orders'));
    }

// public function pending()
// {
//     // Show only products with status 'pending'
//     $products = Product::where('status', 'pending')->with('student')->get();
//     return view('pending', compact('products'));
// }

public function approve(Product $product)
{
   $status = $product->quantity > 0 ? 'live' : 'out_of_stock';

    $product->update([
        'is_approved' => true,
        'status' => $status,
    ]);

    Mail::to($product->student->email)->send(new ProductApproved($product));


    return back()->with('success', 'Product approved and email sent.');
}

public function reject(Product $product)
{
    // Send rejection email before deleting
    Mail::to($product->student->email)->send(new ProductRejected($product));

    // Delete the product entirely
    $product->delete();

    return back()->with('success', 'Product rejected, deleted and email sent.');
}

public function viewReports()
{
    $reports = Report::with(['buyer', 'seller', 'order.product'])->latest()->get();
    return view('admin-report', compact('reports'));
}

public function deleteProduct(Product $product)
{
    $product->delete();

    return back()->with('success', 'Product deleted successfully.');
}

    }


