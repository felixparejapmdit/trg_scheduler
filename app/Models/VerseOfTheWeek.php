<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerseOfTheWeek extends Model
{
    use HasFactory;

    protected $table = 'verseoftheweek';

    protected $fillable = [
        'date',
        'weeknumber',
        'verse',
        'content',
    ];
}
