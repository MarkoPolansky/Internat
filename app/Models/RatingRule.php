<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'min_rating',
        'until'
    ];
    protected $casts = [
        'until' => 'date:H:i',
    ];
    protected $appends = [
        'edited_min_rating',
    ];

    public function getEditedMinRatingAttribute()
    {
        return  $this->min_rating*20;
    }
}
