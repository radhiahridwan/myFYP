<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===================== SHOW PAGES =====================
    public function showSignup()
    {
        return view('auth.signup');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // ===================== SIGNUP =====================
    public function signup(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        // Determine role & default password
        if (preg_match('/^kl\d+@student\.uptm\.edu\.my$/', $data['email'])) {
            $role = 'student';
            $defaultPassword = 'siswiuptm';
        } else {
            $role = 'admin';
            $defaultPassword = 'admin123';
        }

        // Validate password matches default password
        if ($data['password'] !== $defaultPassword) {
            return back()->withErrors([
                'password' => 'You need to input the default password!'
            ])->withInput();
        }

        // Create user record
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $role
        ]);

        // If student, create a linked student profile in 'students' table
        if ($role === 'student') {
            // Extract student ID from email (e.g. kl12345678 from kl12345678@student.uptm.edu.my)
            preg_match('/^kl\d+/', $data['email'], $matches);
            $studentId = $matches[0] ?? null;

            // Get additional student data from the form
            $studentData = $request->validate([
                'student_id' => 'nullable|string|max:50',
                'course' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'hostel_room' => 'nullable|string|max:100',
            ]);

            Student::create([
                'user_id'      => $user->id,
                'student_id'   => $studentData['student_id'] ?? $studentId,
                'course'       => $studentData['course'] ?? null,
                'phone_number' => $studentData['phone_number'] ?? null,
                'address'      => $studentData['address'] ?? null,
                'hostel_room'  => $studentData['hostel_room'] ?? null,
            ]);
        }

        //  Auto-login user after signup
        Auth::login($user);

        // Redirect based on role
        if ($role === 'student') {
            return redirect()->route('students.dashboard')->with('success', 'Signup successful! Welcome, student.');
        } else {
            return redirect()->route('admin.dashboard')->with('success', 'Signup successful! Welcome, admin.');
        }
    }

    // ===================== LOGIN =====================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Validate student email format
        if (str_ends_with($credentials['email'], '@student.uptm.edu.my')) {
            if (!preg_match('/^kl\d+@student\.uptm\.edu\.my$/', $credentials['email'])) {
                return back()->withErrors(['email' => 'Invalid student email format.'])->onlyInput('email');
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role === 'student') {
                return redirect()->route('students.dashboard')->with('success', 'Login successful! Welcome back.');
            } else {
                return redirect()->route('admin.dashboard')->with('success', 'Login successful! Welcome back.');
            }
        }

        return back()->withErrors(['password' => 'Invalid email or password'])->onlyInput('email');
    }

    // ===================== LOGOUT =====================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}