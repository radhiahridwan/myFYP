<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outing extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'student_id',
        'departure_time',
        'expected_return_time',
        'actual_return_time',
        'destination',
        'purpose',
        'emergency_contact_number',
        'emergency_contact_relationship',
        'status'
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'expected_return_time' => 'datetime',
        'actual_return_time' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('status', 'out');
    }

    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }

    public function markAsReturned()
    {
        $this->update([
            'status' => 'returned',
            'actual_return_time' => now()
        ]);
    }
    
    /**
     * Calculate outing duration
    */
    public function getDurationAttribute()
    {
    if ($this->status == 'returned' && $this->actual_return_time) {
        $end = $this->actual_return_time;
    } else {
        $end = now();
    }
    
    $totalHours = $this->departure_time->diffInHours($end);
    $days = floor($totalHours / 24);
    $hours = $totalHours % 24;
    
    if ($days > 0) {
        return "{$days} days {$hours} hours";
    }
    
    return "{$hours} hours";
    }

    /**
    * Calculate overdue duration (for overdue students)
    */
    public function getOverdueDurationAttribute()
    {
    if ($this->status == 'out' && $this->expected_return_time < now()->startOfDay()) {
        $overdueHours = now()->startOfDay()->diffInHours(now());
        $days = floor($overdueHours / 24);
        $hours = $overdueHours % 24;
        
        if ($days > 0) {
            return "{$days} days {$hours} hours";
        }
        
        return "{$hours} hours";
    }
    
    return null;
    }
}