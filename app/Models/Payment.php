<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'amount',
        'receipt',
        'status'
    ];

    protected $attributes = [
        'status' => 'pending'
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the student details through user relationship
     */
    public function student()
    {
        return $this->hasOneThrough(
            Student::class,
            User::class,
            'id', // Foreign key on users table
            'user_id', // Foreign key on students table  
            'student_id', // Local key on payments table
            'id' // Local key on users table
        );
    }

    /**
     * Get the receipt URL
     */
    public function getReceiptUrlAttribute()
    {
        return $this->receipt ? Storage::url($this->receipt) : null;
    }
}