<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'arrived'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

//
//    public function user()
//    {
//        return $this->hasOne(User::class)->whereDate(today())
//    }
}
