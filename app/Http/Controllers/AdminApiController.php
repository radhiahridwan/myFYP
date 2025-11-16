<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Level;
use App\Models\Room;

class AdminApiController extends Controller
{
    // ===== Dashboard Metrics =====
    public function metrics()
    {
        return response()->json([
            'students' => Student::count(),
            'admins' => User::where('role', 'admin')->count(),
        ]);
    }

    // ===== Recent Students =====
    public function recentStudents()
    {
        $students = Student::latest()->take(5)->get(['name', 'email', 'created_at']);
        return response()->json($students);
    }

    // ===== Example Forms Data =====
    public function recentForms()
    {
        $forms = [
            ['student_name' => 'Ali bin Abu', 'form_type' => 'Facility Report'],
            ['student_name' => 'Nur Aisyah', 'form_type' => 'Vehicle Sticker'],
        ];

        return response()->json($forms);
    }

    // ===== Fetch Rooms by Level =====
    public function getRooms($level_id)
    {
        $rooms = Room::where('level_id', $level_id)->get(['id', 'room_name']);
        return response()->json($rooms);
    }

    // ===== Fetch Students by Room =====
    public function getStudents($room_id)
    {
        $students = Student::where('room_id', $room_id)
            ->select('id', 'name', 'student_id', 'email', 'phone_number')
            ->get();

        return response()->json([
            'students' => $students,
        ]);
    }

    // ===== Add New Student =====
    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $student = Student::create([
            'user_id' => null, // system/manual entry
            'name' => $validated['name'],
            'student_id' => $validated['student_id'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'room_id' => $validated['room_id'],
        ]);

        return response()->json([
            'message' => 'Student added successfully',
            'student' => $student
        ]);
    }
    public function addStudent(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'student_id' => 'required|string|max:12|unique:students,student_id',
        'email' => 'required|email|unique:students,email',
        'phone_number' => 'required|string|max:15',
        'room_id' => 'required|integer',
    ]);

    $student = \App\Models\Student::create([
        'name' => $validated['name'],
        'student_id' => $validated['student_id'],
        'email' => $validated['email'],
        'phone_number' => $validated['phone_number'],
        'room_id' => $validated['room_id'],
    ]);

    return response()->json(['message' => 'Student added successfully', 'student' => $student]);
}

}
