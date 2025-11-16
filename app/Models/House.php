<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    // Only need a name (e.g., "Block 11")
    protected $fillable = ['name'];

    // Each house has many levels
    public function levels()
    {
        return $this->hasMany(Level::class, 'house_id');
    }

   
    public function students()
    {
    return $this->hasManyThrough(Student::class, Room::class);
    }

   
    public function rooms()
    {
    return $this->hasManyThrough(Room::class, Level::class);
    }
}
