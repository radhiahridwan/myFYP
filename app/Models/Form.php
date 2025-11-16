<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'data',
        'status',
        'admin_comment'
    ];

    protected $casts = [
        'data' => 'array'
    ];

    const TYPE_VEHICLE_STICKER = 'vehicle_sticker';
    const TYPE_FACILITY_REPORT = 'facility_report';
    const TYPE_CHANGE_ROOM = 'change_room';
    const TYPE_CHECK_OUT = 'check_out';

    const STATUS_PENDING = 'pending';
    const STATUS_UNDER_REVIEW = 'under_review';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add this relationship
    public function student()
    {
            return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(FormComment::class);
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_UNDER_REVIEW => 'info',
            self::STATUS_APPROVED => 'success',
            self::STATUS_REJECTED => 'danger',
            self::STATUS_COMPLETED => 'secondary',
            default => 'light'
        };
    }
}