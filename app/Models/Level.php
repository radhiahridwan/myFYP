<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'level_number'];

    // A level belongs to a house
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    // A level has many rooms
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
