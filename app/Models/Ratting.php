<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratting extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'rating',
        'message'
    ];

    protected $casts = [
        'rating' =>'double',
    ];
    protected $appends = [
        'edited_ratting',
        'day_for_human'
    ];

    public function getEditedRattingAttribute()
    {
        return $this->rating == null ? 'Bez hodnotenia' : $this->rating*20;
    }


    public function getDayForHumanAttribute()
    {
        return  $this->created_at->isoformat('dddd ') . $this->created_at->format('d.m');
    }


    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
