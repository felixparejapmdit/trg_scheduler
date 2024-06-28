<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastSuguan extends Model
{
    use HasFactory;

    protected $table = 'broadcast_suguan';

    protected $fillable = [
        'date',
        'name',
        'tobebroadcast',
    ];
}
