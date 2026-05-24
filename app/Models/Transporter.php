<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Supir;
use App\Models\Fleet;

class Transporter extends Model
{
    use SoftDeletes;
    protected $table = 'transporter';
    protected $primaryKey = 'transporter_id';
    protected $fillable = [
        'transporter_nama',
        'transporter_pic',
        'transporter_hp',
        'transporter_status',
        'flag_deleted',
    ];

    public function supirs()
    {
        return $this->hasMany(Supir::class, 'transporter_id', 'transporter_id');
    }

    public function fleets()
    {
        return $this->hasMany(Fleet::class, 'transporter_id', 'transporter_id');
    }
}
