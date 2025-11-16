<?php

namespace App\Http\Controllers;

use App\Models\Outing;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminOutingController extends Controller
{
    /**
     * Display the admin outing dashboard
     */
    public function index(Request $request)
    {
        // ======================
        // OVERVIEW COUNTS (24 HOURS)
        // ======================
        
        // Currently Out (NOT overdue)
        $currentOutCount = Outing::where('status', 'out')
            ->where('expected_return_time', '>=', now()->startOfDay())
            ->count();

        // Recently Returned (LAST 24 HOURS - for overview card)
        $recentReturnCount = Outing::where('status', 'returned')
            ->where('actual_return_time', '>=', now()->subDay())
            ->count();

        // Overdue Returns (STILL OUT but past midnight)
        $overdueCount = Outing::where('status', 'out')
            ->where('expected_return_time', '<', now()->startOfDay())
            ->count();

        // ======================
        // DETAILED DATA
        // ======================
        
        // Currently Out Students (NOT overdue)
        $currentOutings = Outing::with('student')
            ->where('status', 'out')
            ->where('expected_return_time', '>=', now()->startOfDay())
            ->orderBy('departure_time', 'desc')
            ->get();

        // Overdue Students (STILL OUT but overdue)
        $overdueOutings = Outing::with('student')
            ->where('status', 'out')
            ->where('expected_return_time', '<', now()->startOfDay())
            ->orderBy('expected_return_time', 'asc')
            ->get();

        // Recently Returned Students (FILTERABLE)
        $timeFilter = $request->get('return_filter', '24hours');
        
        $recentReturnsQuery = Outing::with('student')
            ->where('status', 'returned');

        // Apply time filter
        switch ($timeFilter) {
            case '24hours':
                $recentReturnsQuery->where('actual_return_time', '>=', now()->subDay());
                break;
            case '3days':
                $recentReturnsQuery->where('actual_return_time', '>=', now()->subDays(3));
                break;
            case '1week':
                $recentReturnsQuery->where('actual_return_time', '>=', now()->subWeek());
                break;
            case '1month':
                $recentReturnsQuery->where('actual_return_time', '>=', now()->subMonth());
                break;
            // 'all' shows everything, no filter needed
        }

        $recentReturns = $recentReturnsQuery->orderBy('actual_return_time', 'desc')
            ->paginate(20);

        return view('admin.outings', compact(
            'currentOutCount',
            'recentReturnCount', 
            'overdueCount',
            'currentOutings',
            'overdueOutings',
            'recentReturns',
            'timeFilter'
        ));
    }

    /**
     * Mark a student as returned (admin override)
     */
    public function markReturned($id)
    {
        $outing = Outing::findOrFail($id);
        
        $outing->update([
            'status' => 'returned',
            'actual_return_time' => now()
        ]);

        return redirect()->route('admin.outings')
            ->with('success', 'Student marked as returned successfully!');
    }

    /**
     * Export current outings to Excel
     */
    public function exportExcel()
    {
        // We'll implement this later
        return redirect()->back()->with('info', 'Export feature coming soon!');
    }

    /**
     * Export current outings to PDF
     */
    public function exportPDF()
    {
        // We'll implement this later  
        return redirect()->back()->with('info', 'PDF export feature coming soon!');
    }
}