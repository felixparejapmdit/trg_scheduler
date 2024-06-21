<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'reminder_datetime',
        'reminder',
        'week_number',
        'verse_of_the_week',
        'incharge',
        'prepared_by',
        'status',
        'priority'
    ];

    protected $casts = [
        'reminder_datetime' => 'datetime',
    ];
}
