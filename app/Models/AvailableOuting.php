<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableOuting extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'user_id',
        'until'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
