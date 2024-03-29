<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableOuting extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'user_id',
        'until',
        'is_banned'
    ];

    protected $casts = [
        'until' => 'date:H:i'
    ];
    protected $appends = [
        'is_late_for_outing'
    ];

    public function getIsLateForOutingAttribute()
    {
        if (isset($this->until))
           return $this->until < Carbon::now();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
