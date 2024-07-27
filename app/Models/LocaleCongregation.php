<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocaleCongregation extends Model
{
    use HasFactory;

    protected $table = 'locale_congregations';

    protected $fillable = [
        'name',
        'district_id',
    ];


     public function district()
    {
        return $this->belongsTo(District::class);
    }
}
