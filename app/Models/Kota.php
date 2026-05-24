<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use SoftDeletes;
    protected $table = 'm_kota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'propinsi_id',
        'kota_nama',
        'kota_kode',
    ];

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class, 'propinsi_id', 'id');
    }
}
