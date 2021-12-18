<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'available_activity_id'
    ];

    public function user()
    {
        return $this->belongsto(User::class);
    }

    public function available_activity()
    {
        return $this->belongsto(AvailableActivity::class);
    }


}
