<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propinsi extends Model
{
    use SoftDeletes;
    protected $table = 'm_propinsi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'propinsi_nama',
        'propinsi_kode',
    ];
}
