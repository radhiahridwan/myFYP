<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'role', // 'student' or 'admin'
    ];

    // Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    /**
     * Get the payments for the user (through student)
     */
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Student::class, 'user_id', 'student_id');
    }

}
