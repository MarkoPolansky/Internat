<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'apartment_id',
        'class',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function rattings()
    {
        return $this->hasMany(Ratting::class);
    }

    public function available_outing()
    {
        return $this->hasOne(AvailableOuting::class)->latest();
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function todayVote()
    {
        return $this->hasOne(ActivityVote::class)->whereDate('created_at',today());
    }






}
