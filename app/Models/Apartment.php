<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function rattings()
    {
        return $this->hasMany(Ratting::class);
    }
    public function lastWeekRattings()
    {
        return $this->hasMany(Ratting::class)->whereDate('created_at','>',Carbon::today()->subWeek());
    }

    public function todayRatting()
    {
        return $this->hasOne(Ratting::class)->whereDate('created_at',today());

    }
}
