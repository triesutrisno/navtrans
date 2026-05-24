<?php

namespace App\Models;

use App\Models\Fleet;
use Illuminate\Database\Eloquent\Model;

class JenisFleet extends Model
{
    protected $table = 'jenis_fleet';
    protected $primaryKey = 'jns_fleet_id';

    protected $fillable = [
        'jns_fleet_kode',
        'jns_fleet_nama',
        'jns_fleet_tonase',
        'flag_deleted',
    ];

    public function fleets()
    {
        return $this->hasMany(Fleet::class, 'jns_fleet_id', 'jns_fleet_id');
    }
}
