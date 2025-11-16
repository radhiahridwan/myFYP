<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'room_number', 'capacity'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'hostel_room', 'room_number');
    }
   
    public function occupiedBeds()
    {
    return $this->students()->count();
    }

    public function availableBeds()
    {
    return $this->capacity - $this->occupiedBeds();
    }

    public function isFull()
    {
    return $this->occupiedBeds() >= $this->capacity;
    }

                
    public static function rules()
    {
    return [
        'level_id' => 'required|exists:levels,id',
        'room_number' => 'required|string|max:10',
        'capacity' => 'required|integer|min:1|max:20'
    ];
    }
}
