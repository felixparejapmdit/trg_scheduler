<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function localeCongregations()
    {
        return $this->hasMany(LocaleCongregation::class);
    }

    public function suguan()
{
    return $this->hasMany(Suguan::class);
}

}
