<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        // ✅ Basic validation
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6|confirmed',
            'student_id'    => 'nullable|string|max:50',
            'course'        => 'nullable|string|max:100',
            'phone_number'  => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'hostel_room'   => 'nullable|string|max:50',
        ]);

        $email = $request->email;

        // ✅ Automatically detect role
        if (preg_match('/^kl\d+@student\.uptm\.edu\.my$/', $email)) {
            $role = 'student';
        } else {
            $role = 'admin';
        }

        // ✅ Create base user record
        $user = User::create([
            'name'     => $request->name,
            'email'    => $email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        // ✅ Create role-specific record
        if ($role === 'student') {
            Student::create([
                'user_id'      => $user->id,
                'name'         => $request->name,
                'email'        => $email,
                'student_id'   => $request->student_id ?? '',
                'course'       => $request->course ?? '',
                'phone_number' => $request->phone_number ?? '',
                'address'      => $request->address ?? '',
                'hostel_room'  => $request->hostel_room ?? '',
            ]);
        } else {
            Admin::create([
                'user_id'      => $user->id,
                'name'         => $request->name,
                'email'        => $email,
                'phone_number' => $request->phone_number ?? '',
            ]);
        }

        return redirect('/login')->with('success', 'Account created successfully! Please log in.');
    }
}
