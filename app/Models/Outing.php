<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'available_outing_id',
        'arrived',
    ];

    protected $appends = [
        'is_late'
    ];

    public function getIsLateAttribute()
    {

        return $this->available_outing->until < Carbon::now() ;
    }
//    public function getDayForHumanAttribute()
//    {
//        return  $this->day->isoformat('dddd D');
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function available_outing()
    {
        return $this->belongsTo(AvailableOuting::class);
    }


    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
