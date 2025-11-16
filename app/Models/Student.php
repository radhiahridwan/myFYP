<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'student_id',
        'course',
        'phone_number',
        'address',
        'hostel_room', 
    ];

    /**
     * Each student belongs to one user account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each student belongs to one room
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'hostel_room', 'room_number'); 
    }

    /**
     * Access the student's level through their room
     */
    public function level()
    {
        return $this->hasOneThrough(
            Level::class,
            Room::class,
            'room_number',
            'id',        
            'hostel_room', 
            'level_id'   
        );
    }

    /**
     * Shortcut: Access the student's level directly
     */
    public function getLevelAttribute()
    {
        return $this->room?->level;
    }

    /**
     * Shortcut: Access the student's house through their level
     */
    public function getHouseAttribute()
    {
        return $this->room?->level?->house;
    }

    /**
     * Each student can have many payments
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function outings()
    {
        return $this->hasMany(Outing::class);
    }
}