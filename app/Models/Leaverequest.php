<?php

namespace App\Models;

use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leaverequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function (Leaverequest $leaverequest) {
            $leaverequest->status = 'pending';
            $leaverequest->user_id = Auth::id();
        });
    }


    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['search'] ?? '', function ($builder, $value) {
            $builder->where(function ($builder) use ($value) {
                $builder->where('name', 'LIKE', "%{$value}%");
            });
        });
    }


    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function getLeaveDateAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->format('Y-m-d');
        }
    }
}
