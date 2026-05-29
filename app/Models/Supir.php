<?php

namespace App\Models;

use App\Models\Fleet;
use App\Models\JenisSim;
use App\Models\Transporter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supir extends Model
{
    use SoftDeletes;
    protected $table = 'supir';
    protected $primaryKey = 'supir_id';

    protected $fillable = [
        'jns_sim_id',
        'transporter_id',
        'driver_nama',
        'driver_ktp',
        'driver_hp',
        'driver_no_sim',
        'driver_no_bpjs',
        'tgl_exipred_sim',
        'flag_blokir',
        'driver_status',
        'flag_deleted',
    ];

    public function transporter()
    {
        return $this->belongsTo(Transporter::class, 'transporter_id', 'transporter_id');
    }

    public function jenisSim()
    {
        return $this->belongsTo(JenisSim::class, 'jns_sim_id', 'jns_sim_id');
    }

    public function fleets()
    {
        return $this->hasMany(Fleet::class, 'supir_id', 'supir_id');
    }
}
