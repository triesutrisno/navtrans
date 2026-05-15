<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menurole extends Model
{
    use SoftDeletes;
    protected $table = 'menurole'; // karena bukan 'menus'
    protected $primaryKey = 'menurole_id'; // primary ke untuk tabel menurole
    protected $fillable = [
        'menurole_id',
        'menu_id',
        'role_nama',
        'menurole_status',
        'mrc',
        'mrr',
        'mru',
        'mrd',
    ];
}
