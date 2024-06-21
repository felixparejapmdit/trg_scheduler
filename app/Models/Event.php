<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'event_datetime',
        'title',
        'description',
        'incharge',
        'prepared_by',
        'status',
        'priority',
        'recurring'
    ];
}
