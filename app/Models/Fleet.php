<?php

namespace App\Models;

use App\Models\Supir;
use App\Models\Transporter;
use App\Models\JenisFleet;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $table = 'fleet';
    protected $primaryKey = 'fleet_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'jns_fleet_id',
        'transporter_id',
        'supir_id',
        'fleet_nopol',
        'fleet_nopin',
        'thn_pembuatan',
        'no_stnk',
        'tgl_expired_kir',
        'tgl_expired_stnk',
        'tgl_expired_pajak',
        'flag_blokir',
        'alasan_blokir',
        'fleet_status',
        'vendor_gps',
        'emai',
        'created_by',
        'updated_by',
        'deleted_by',
        'flag_deleted',
    ];

    public function supir()
    {
        return $this->belongsTo(Supir::class, 'supir_id', 'supir_id');
    }

    public function transporter()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id', 'transporter_id');
    }

    public function jenisFleet()
    {
        return $this->belongsTo(JenisFleet::class, 'jns_fleet_id', 'jns_fleet_id');
    }
}
