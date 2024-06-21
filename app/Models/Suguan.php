<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suguan extends Model
{
    use HasFactory;

    protected $table = 'suguan';

    protected $fillable = [
        'name',
        'lokal',
        'district',
        'suguan_datetime',
        'gampanin',
        'prepared_by',
        'comments'
    ];
}
