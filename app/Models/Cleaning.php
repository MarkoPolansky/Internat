<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'day'
    ];

    protected $casts=[
        'day' => 'date'
    ];

    protected $appends = [
        'day_for_human',
    ];

    public function getDayForHumanAttribute()
    {
        return  $this->day->isoformat('dddd D');
    }
}
