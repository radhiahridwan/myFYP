<?php

namespace App\Http\Controllers;

use App\Models\Outing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentOutingController extends Controller
{
    /**
     * Check for overlapping outings
     */
    private function hasOverlappingOuting($studentId, $departureTime, $returnTime)
    {
        return Outing::where('student_id', $studentId)
            ->where('status', 'out')
            ->where(function($query) use ($departureTime, $returnTime) {
                $query->whereBetween('departure_time', [$departureTime, $returnTime])
                      ->orWhereBetween('expected_return_time', [$departureTime, $returnTime])
                      ->orWhere(function($q) use ($departureTime, $returnTime) {
                          $q->where('departure_time', '<=', $departureTime)
                            ->where('expected_return_time', '>=', $returnTime);
                      });
            })
            ->exists();
    }

    /**
     * Display the outing form
     */
    public function create()
    {
        $student = Auth::user()->student;
        return view('students.outing', [
            'student' => $student,
            'page' => 'form'
        ]);
    }

    /**
     * Store a newly created outing
     */
    public function store(Request $request)
    {
        $request->validate([
            'departure_time' => 'required|date|after_or_equal:today', 
            'expected_return_time' => 'required|date|after:departure_time',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:500',
            'emergency_contact_number' => 'required|string|max:20',
            'emergency_contact_relationship' => 'required|string|max:50',
        ]);

        $studentId = Auth::user()->student->id;

        // Check for overlapping outings
        if ($this->hasOverlappingOuting($studentId, $request->departure_time, $request->expected_return_time)) {
            return redirect()->back()
                ->with('error', 'You already have an active outing during this time period. Please delete the existing one or modify your dates.')
                ->withInput();
        }

        Outing::create([
            'student_id' => $studentId,
            'departure_time' => $request->departure_time,
            'expected_return_time' => $request->expected_return_time,
            'destination' => $request->destination,
            'purpose' => $request->purpose,
            'emergency_contact_number' => $request->emergency_contact_number,
            'emergency_contact_relationship' => $request->emergency_contact_relationship,
            'status' => 'out'
        ]);

        return redirect()->route('outing.current')
            ->with('success', 'Outing form submitted successfully!');
    }

    /**
     * Display current active outing for the student
     */
    public function showCurrent()
    {
        $student = Auth::user()->student;
        $currentOutings = Outing::where('student_id', $student->id)
            ->where('status', 'out')
            ->orderBy('departure_time', 'desc')
            ->get();

        return view('students.outing', [
            'currentOutings' => $currentOutings,
            'student' => $student,
            'page' => 'current'
        ]);
    }

    /**
     * Mark outing as returned
     */
    public function markReturned($id)
    {
        $outing = Outing::where('student_id', Auth::user()->student->id)
            ->where('id', $id)
            ->firstOrFail();

        $outing->markAsReturned();

        return redirect()->route('outing.current')
            ->with('success', 'Welcome back! Your return has been recorded.');
    }

    /**
     * Display outing history for the student
     */
    public function history()
    {
        $student = Auth::user()->student;
        $outings = Outing::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('students.outing', [
            'outings' => $outings,
            'student' => $student,
            'page' => 'history'
        ]);
    }

    /**
     * Delete an outing
     */
    public function destroy($id)
    {
        $outing = Outing::where('student_id', Auth::user()->student->id)
            ->where('id', $id)
            ->firstOrFail();

        // Only allow deletion of future outings or current outings
        $canDelete = true;
        
        if ($outing->status == 'returned') {
            $sevenDaysAgo = now()->subDays(7);
            if ($outing->actual_return_time && $outing->actual_return_time < $sevenDaysAgo) {
                $canDelete = false;
            }
        }

        if (!$canDelete) {
            return redirect()->back()->with('error', 'Cannot delete outings that were returned more than 7 days ago.');
        }

        $outing->delete();

        return redirect()->back()->with('success', 'Outing deleted successfully.');
    }
}