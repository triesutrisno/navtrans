<?php

namespace App\Models;

use App\Models\Supir;
use Illuminate\Database\Eloquent\Model;

class JenisSim extends Model
{
    protected $table = 'jenis_sim';
    protected $primaryKey = 'jns_sim_id';

    protected $fillable = [
        'jns_sim_nama',
        'flag_deleted',
    ];

    public function supirs()
    {
        return $this->hasMany(Supir::class, 'jns_sim_id', 'jns_sim_id');
    }
}
