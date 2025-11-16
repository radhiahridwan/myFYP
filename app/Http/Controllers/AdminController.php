<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Admin;
use App\Models\House;
use App\Models\Level;
use App\Models\Rule;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
   // ===== Dashboard =====
    public function dashboard()
    {
        $totalStudents = Student::count();
        $totalAdmins = \App\Models\User::where('role', 'admin')->count(); // Adjust based on your User model
        $pendingPayments = Payment::where('status', 'pending')->count();
        $totalForms = \App\Models\Form::count(); // Assuming you have a Form model

        $recentStudents = Student::latest()->take(5)->get();
        $recentForms = \App\Models\Form::with('student')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 
            'totalAdmins', 
            'pendingPayments', 
            'totalForms', 
            'recentStudents', 
            'recentForms'
        ));
    }

    // ===== Students =====
    public function students()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        return view('admin.students', compact('students'));
    }

    // ===== Rooms =====
    public function rooms()
    {
        $houses = House::with('levels.rooms')->get();
        $levels = Level::all();
        return view('admin.rooms', compact('houses', 'levels'));
    }

    // ===== Profile =====
    public function profile()
    {
        $admin = Auth::user();
        
        // If you need to get the admin record with user data
        $adminWithUser = \App\Models\Admin::where('user_id', $admin->id)->first();
        
        return view('admin.profile', compact('admin', 'adminWithUser'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $admin = \App\Models\Admin::where('user_id', $user->id)->first();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20', // Changed from 'phone' to 'phone_number'
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle profile picture (stored in users table)
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->save();
        }

        // Update users table
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update admins table (phone_number)
        if ($admin) {
            $admin->phone_number = $request->phone_number;
            $admin->save();
        }

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    // ===== Rules Management =====
    public function rules()
    {
        $rules = Rule::orderBy('created_at', 'desc')->get();
        $editRule = null;
        return view('admin.rules', compact('rules', 'editRule'));
    }

    public function storeRule(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|max:2048',
            ]);

            $path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('rules', 'public');
            }

            // REMOVED the line: $rule->image = $path; (this was causing the error)

            $rule = Rule::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path, // This goes directly in the create method
            ]);

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Rule added successfully.',
                'rule' => [
                    'id' => $rule->id,
                    'title' => $rule->title,
                    'description' => $rule->description,
                    'image' => $rule->image,
                    'created_at' => $rule->created_at->toDateTimeString(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function editRule($id)
    {
        $rules = Rule::orderBy('created_at', 'desc')->get();
        $editRule = Rule::findOrFail($id);
        return view('admin.rules', compact('rules', 'editRule'));
    }

    public function updateRule(Request $request, $id)
    {
        try {
            $rule = Rule::findOrFail($id);

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|max:2048',
            ]);

            // only update image if a new one is uploaded
            if ($request->hasFile('image')) {
                if ($rule->image) {
                    Storage::disk('public')->delete($rule->image);
                }
                $rule->image = $request->file('image')->store('rules', 'public');
            }

            $rule->title = $request->title;
            $rule->description = $request->description;
            $rule->save();

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Rule updated successfully.',
                'rule' => [
                    'id' => $rule->id,
                    'title' => $rule->title,
                    'description' => $rule->description,
                    'image' => $rule->image,
                    'created_at' => $rule->created_at->toDateTimeString(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function deleteRule($id)
    {
        try {
            $rule = Rule::findOrFail($id);

            if ($rule->image) {
                Storage::disk('public')->delete($rule->image);
            }

            $rule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Rule deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
    // ===== Payments Management =====
    public function payments()
    {
        $payments = Payment::with('student.house')->get();

        $totalStudents = Student::count();
        $totalPaid = Payment::where('status', 'paid')->count();
        $totalPending = Payment::where('status', 'pending')->count();

        return view('admin.payments.index', compact('payments', 'totalStudents', 'totalPaid', 'totalPending'));
    }

    public function markPaymentPaid($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'paid';
        $payment->save();

        return redirect()->route('admin.payments')->with('success', 'Payment marked as paid.');
    }

    public function viewPayment($id)
    {
        $payment = Payment::with('student.house')->findOrFail($id);
        return view('admin.payments.view', compact('payment'));
    }
        public function dashboardOutings()
    {
        $currentOutings = Outing::with('user')
            ->where('status', 'out')
            ->orderBy('out_time', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($outing) {
                return [
                    'id' => $outing->id,
                    'name' => $outing->user->name ?? 'Unknown',
                    'out_time' => $outing->out_time->toDateTimeString(),
                    'purpose' => $outing->purpose
                ];
            });

        $recentReturns = Outing::with('user')
            ->where('status', 'returned')
            ->where('return_time', '>=', now()->subDay())
            ->orderBy('return_time', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($outing) {
                return [
                    'id' => $outing->id,
                    'name' => $outing->user->name ?? 'Unknown',
                    'return_time' => $outing->return_time->toDateTimeString(),
                    'out_time' => $outing->out_time->toDateTimeString()
                ];
            });

        return response()->json([
            'current_outings' => $currentOutings,
            'recent_returns' => $recentReturns
        ]);
    }

    public function dashboardForms()
    {
        $recentForms = Form::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($form) {
                return [
                    'id' => $form->id,
                    'student_name' => $form->user->name ?? 'Unknown',
                    'form_type' => $form->type,
                    'created_at' => $form->created_at->toDateTimeString(),
                    'status' => $form->status
                ];
            });

        return response()->json([
            'recent_forms' => $recentForms
        ]);
    }
    // Add these methods to AdminController
    public function showSettings()
    {
        return view('admin.setting');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return with success message showing the new password
        return back()->with('success', [
            'message' => 'Password updated successfully!',
            'new_password' => $request->new_password
        ]);
    }
}
