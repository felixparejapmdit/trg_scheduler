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
        'lokal_id',
        'district_id',
        'suguan_datetime',
        'gampanin',
        'prepared_by',
        'comments',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function lokal()
    {
        return $this->belongsTo(LocaleCongregation::class, 'lokal_id', 'id');
    }
}
