<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Level;
use App\Models\Room;
use App\Models\Student;

class AdminRoomController extends Controller
{
    public function index()
    {
        $houses = House::with(['levels.rooms.students'])->get();
        return view('admin.rooms', compact('houses'));
    }

    public function getRooms($level)
    {
        $rooms = Room::whereHas('level', function($query) use ($level) {
            $query->where('level_number', $level);
        })->get();

        // Calculate available beds for each room
        $rooms->each(function($room) {
            $room->available_beds = $room->availableBeds();
        });

        return response()->json(['rooms' => $rooms]);
    }

    public function getStudents($roomId)
    {
        // Get the room first to get room_number
        $room = Room::find($roomId);
        
        if (!$room) {
            return response()->json(['students' => []]);
        }

        // Get students by hostel_room (room_number)
        $students = Student::where('hostel_room', $room->room_number)->get();
        
        return response()->json(['students' => $students]);
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'room_id' => 'required|exists:rooms,id'
        ]);

        // Get the room to get room_number
        $room = Room::find($request->room_id);
        
        if (!$room) {
            return response()->json([
                'message' => 'Room not found'
            ], 404);
        }

        // Check room capacity
        if ($room->isFull()) {
            return response()->json([
                'message' => 'Room ' . $room->room_number . ' is already at full capacity (' . $room->capacity . ' students)'
            ], 422);
        }

        // Find the existing student
        $student = Student::where('student_id', $request->student_id)->first();

        // Check if student already has a room
        if ($student->hostel_room) {
            $currentRoom = $student->hostel_room;
            return response()->json([
                'message' => "Student {$student->name} already has a room assigned: {$currentRoom}"
            ], 422);
        }

        // Assign student to room
        $student->update(['hostel_room' => $room->room_number]);

        return response()->json([
            'message' => "Student {$student->name} assigned to {$room->room_number} successfully"
        ]);
    }

    // Method to get students without rooms
    public function getStudentsWithoutRooms()
    {
        $students = Student::whereNull('hostel_room')
            ->orWhere('hostel_room', '')
            ->select('id', 'student_id', 'name', 'email')
            ->get();
        
        return response()->json(['students' => $students]);
    }

    // Optional: Method to remove student from room
    public function removeStudentFromRoom(Request $request, $studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $roomNumber = $student->hostel_room;
            
            $student->update(['hostel_room' => null]);

            return response()->json([
                'message' => 'Student removed from ' . $roomNumber . ' successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error removing student: ' . $e->getMessage()
            ], 500);
        }
    }

    // Optional: Method to assign existing student to room (you can remove this since addStudent does the same)
    public function assignStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'room_id' => 'required|exists:rooms,id'
        ]);

        $room = Room::find($request->room_id);
        $student = Student::where('student_id', $request->student_id)->first();

        if ($room->isFull()) {
            return response()->json([
                'message' => 'Room is already at full capacity'
            ], 422);
        }

        $student->update(['hostel_room' => $room->room_number]);

        return response()->json([
            'message' => 'Student assigned to room successfully'
        ]);
    }

    // NEW METHOD: Update student information from room page
    public function updateStudentInRoom(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);
            
            // Only validate fields we're actually updating in room page
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'student_id' => 'required|string|max:255|unique:students,student_id,' . $id,
                'phone_number' => 'nullable|string|max:20',
            ]);

            // Update only the fields we're editing in room page
            $student->update([
                'name' => $validated['name'],
                'student_id' => $validated['student_id'],
                'phone_number' => $validated['phone_number'],
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'student' => $student
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}