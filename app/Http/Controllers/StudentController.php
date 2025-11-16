<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Rule;
use App\Models\Student;
use App\Models\Room;
use App\Models\Outing;

class StudentController extends Controller
{
    /**
     * Show the profile page (view + edit on same page).
     */
    public function profile()
    {
        $user = Auth::user();

        // Try to find matching student record (linked via user_id)
        $student = Student::where('user_id', $user->id)->first();

        // If no student record found, create a temporary one from user data for the form
        if (!$student) {
            $student = new Student([
                'user_id' => $user->id,
                'name' => $user->name,
                'student_id' => $user->student_id,
                'course' => '',
                'phone_number' => '',
                'address' => '',
                'hostel_room' => '',
            ]);
        }

        // Get all rooms for the dropdown
        $rooms = Room::all();

        return view('students.profile', compact('user', 'student', 'rooms'));
    }

    public function updateProfile(Request $request) {
    $user = Auth::user();

    // Find or create student record using user_id
    $student = Student::where('user_id', $user->id)->first();

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|string|max:50',
        'course' => 'required|string|max:100',
        'phone_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'hostel_room' => 'nullable|string|max:50',
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

    // Create student record if it doesn't exist
    if (!$student) {
        $student = new Student();
        $student->user_id = $user->id; // Set the user_id
        $student->student_id = $request->student_id;
    }

    // Update student info (in students table)
    $student->name = $request->name;
    $student->student_id = $request->student_id;
    $student->course = $request->course;
    $student->phone_number = $request->phone_number;
    $student->address = $request->address;
    $student->hostel_room = $request->hostel_room;
    $student->save();

    // Also sync basic info back to users table for display consistency
    $user->name = $request->name;
    $user->save();

    return redirect()->route('students.profile')->with('success', 'Profile updated successfully!');
    }

    /**
    * Show the list of wardens (admins).
    */
    public function wardens()
    {
    $wardens = User::where('role', 'admin')
        ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
        ->select('users.*', 'admins.phone_number')
        ->get();
    return view('students.wardens', compact('wardens'));
    }

    /**
     * Show the rules page (read-only for students).
     */
    public function rules()
    {
        $rules = Rule::all();
        return view('students.rules', compact('rules'));
    }

    /**
     * Show the user manual page.
     */
    public function manual()
    {
        return view('students.manual');
    }

    /**
     * Show the outing form.
     */
    public function outingForm()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('students.profile')
                ->with('error', 'Please complete your profile before submitting an outing form.');
        }

        return view('students.outing', [
            'student' => $student,
            'page' => 'form'
        ]);
    }

    /**
     * Show current active outing.
     */
    public function currentOuting()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('students.profile')
                ->with('error', 'Please complete your profile first.');
        }

        $currentOuting = Outing::where('student_id', $student->id)
            ->where('status', 'out')
            ->orderBy('departure_time', 'desc')
            ->get();

        return view('students.outing', [
            'currentOutings' => $currentOuting,
            'student' => $student,
            'page' => 'current'
        ]);
    }

    /**
     * Show outing history.
     */
    public function outingHistory()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->route('students.profile')
                ->with('error', 'Please complete your profile first.');
        }

        $outings = Outing::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('students.outing', [
              'outings' => $outings,
                'student' => $student,
                'page' => 'history'
        ]);
    }

    // Add these methods to your StudentController

    public function showSettings()
    {
        return view('students.setting');
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