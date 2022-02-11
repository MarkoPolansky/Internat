<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableActivity extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function todayVoters()
    {
        return $this->hasMany(ActivityVote::class)->whereDate('created_at',today());
    }


}


