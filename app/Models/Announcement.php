<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'visible_until'
    ];

    protected $casts = [
        'visible_until' => 'date'
    ];
    protected $appends = [
        'number_of_days'
    ];

    public function getNumberOfDaysAttribute()
    {
        if ($this->visible_until == null)
            return null;

        $days = Carbon::create($this->visible_until)->diffInDays(today()) ;

        if($days === 0)
            return 'dnes';
        elseif ($days === 1)
            return $days . ' deň';
        elseif ($days === 2 ||$days === 3 ||$days === 4)
            return $days . ' dni';
        else return $days . ' dní';

    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
