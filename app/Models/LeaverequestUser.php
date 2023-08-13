<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaverequestUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'leaverequest_id', 'send_at', 'status', 'date', 'duration'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function getLeaveDateAttribute()
    {
        if ($this->date) {
            return $this->date->format('Y-m-d');
        }
    }
}
