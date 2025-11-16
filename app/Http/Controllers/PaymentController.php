<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User; // Add this import
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // ======================
    // ADMIN METHODS
    // ======================

    // Show all payments for admin dashboard with search
    public function index(Request $request)
    {
        $query = Payment::with(['user.student'])->latest(); // Use 'user.student'

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user.student', function($q) use ($search) { // Use 'user.student'
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('student_id', 'like', '%'.$search.'%');
            });
        }

        $payments = $query->get();
        $totalStudents = Student::count();
        $totalPaid = Payment::where('status', 'paid')->count();
        $totalPending = Payment::where('status', 'pending')->count();

        return view('admin.payments', compact(
            'payments', 
            'totalStudents', 
            'totalPaid', 
            'totalPending'
        ));
    }

    // Update payment status (admin) - This should be fine as is
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,rejected'
        ]);

        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('admin.payments')->with('success', 'Payment status updated successfully.');
    }

    // Delete payment (admin) - This should be fine as is
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        
        // Delete the receipt file if it exists
        if ($payment->receipt && Storage::disk('public')->exists($payment->receipt)) {
            Storage::disk('public')->delete($payment->receipt);
        }
        
        $payment->delete();

        return redirect()->route('admin.payments')->with('success', 'Payment record deleted successfully.');
    }

       

    // View receipt (admin) - This should be fine as is
    public function viewReceipt($id)
    {
        $payment = Payment::findOrFail($id);
        
        if (!$payment->receipt || !Storage::disk('public')->exists($payment->receipt)) {
            abort(404, 'Receipt not found');
        }
        
        $filePath = storage_path('app/public/' . $payment->receipt);
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
        ]);
    }

    // Download receipt (admin) - This should be fine as is
    public function downloadReceipt($id)
    {
        $payment = Payment::findOrFail($id);
        
        if (!$payment->receipt || !Storage::disk('public')->exists($payment->receipt)) {
            abort(404, 'Receipt not found');
        }
        
        $originalName = basename($payment->receipt);
        return Storage::disk('public')->download($payment->receipt, 'receipt_' . $payment->student_id . '_' . $originalName);
    }

    // ======================
    // STUDENT METHODS
    // ======================

    // Show payment page for the logged-in student
    public function studentIndex()
    {
        $payments = Payment::where('student_id', auth()->id())->latest()->get();
        
        return view('students.payments', compact('payments'));
    }

    // Handle student payment receipt upload
    public function uploadReceipt(Request $request)
    {
        $request->validate([
            'receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'amount' => 'required|numeric|min:0',
        ]);

        $student = Student::where('user_id', auth()->id())->firstOrFail();
        $path = $request->file('receipt')->store('receipts', 'public');

        Payment::create([
            'student_id' => auth()->id(), // Using user ID
            'amount' => $request->amount,
            'receipt' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('students.payments')->with('success', 'Receipt uploaded successfully! Waiting for admin verification.');
    }
}