<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;
    protected $table = 'm_kecamatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kota_id',
        'kecamatan_nama',
        'kecamatan_kode',
    ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }
}
