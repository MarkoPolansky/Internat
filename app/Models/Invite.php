<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Invite extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'token',
        'expires_at'
    ];
    protected $casts = [
        'expires_at' => 'datetime'
    ];
    protected $appends = [
        'status',

    ];

    public function getStatusAttribute()
    {
        return Carbon::now()->diffInDays($this->expires_at) >=0 ? Carbon::now()->diffInDays($this->expires_at) : 'Po expirácii';
    }


}
