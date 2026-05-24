<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lokasi extends Model
{
    use SoftDeletes;
    protected $table = 'm_lokasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kecamatan_id',
        'lokasi_kode',
        'lokasi_nama',
        'lokasi_alamat',
        'lokasi_tipe',
        'lokasi_kontak',
        'is_plant',
        'is_shipto',
        'latitude1',
        'longitude1',
        'radius1',
        'lokasi_pic',
        'lokasi_status',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}
