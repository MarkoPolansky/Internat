<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'available_activity_id',
        'starts_at',
        'ends_at',
        'send_email'
    ];

    protected $casts = [
        'starts_at' => 'date:H:i',
        'ends_at' => 'date:H:i',
    ];

    public function availableActivity()
    {
        return $this->belongsTo(AvailableActivity::class);
    }

    public function scopeTodayActivities($query)
    {
        return $query->whereDate('created_at',today());
    }
}
