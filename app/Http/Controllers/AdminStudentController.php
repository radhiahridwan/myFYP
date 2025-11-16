<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use PDF;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['room.level.house'])->get();
        return view('admin.students', compact('students'));
    }

        public function fetchAll(Request $request)
    {
        // Load students with their room relationship (for room_number)
        $query = Student::with('room');

        // Add search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('room', function($roomQuery) use ($search) {
                      $roomQuery->where('room_number', 'like', "%{$search}%");
                  });
            });
        }

        $students = $query->get();

        // Return as JSON so JavaScript can use it
        return response()->json($students);
    }

        // In AdminStudentController.php
        public function update(Request $request, $id)
        {
            try {
                \Log::info('Update student request:', ['id' => $id, 'data' => $request->all()]);
                
                $student = Student::findOrFail($id);
                
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'student_id' => 'required|string|max:255|unique:students,student_id,' . $id,
                    'email' => 'required|email|unique:students,email,' . $id,
                    'phone_number' => 'nullable|string|max:20',
                    'address' => 'nullable|string|max:500',
                    'room_number' => 'nullable|string|max:50' 
                ]);

                \Log::info('Validated data:', $validated);
                
                // Update basic student info
                $student->update([
                    'name' => $validated['name'],
                    'student_id' => $validated['student_id'],
                    'email' => $validated['email'],
                    'phone_number' => $validated['phone_number'],
                    'address' => $validated['address'],
                    'hostel_room' => $validated['room_number']
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Student updated successfully',
                    'student' => $student
                ]);
                
            } catch (\Illuminate\Validation\ValidationException $e) {
                \Log::error('Validation error:', $e->errors());
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            } catch (\Exception $e) {
                \Log::error('Update student error:', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Server error: ' . $e->getMessage()
                ], 500);
            }
        }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function exportPDF()
    {
        $students = Student::all();
        $pdf = PDF::loadView('pdf.students', compact('students')); // Changed to 'student'
        return $pdf->download('students-' . date('Y-m-d') . '.pdf');
    }
}