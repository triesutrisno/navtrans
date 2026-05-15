<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'role'; // karena bukan 'roles'
    protected $primaryKey = 'role_nama'; // primary ke untuk tabel role
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'role_nama',
        'role_keterangan',
        'role_status',
        'menu_type',
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'userrole',
            'role_nama',
            'user_id'
        );
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'menurole',
            'role_nama',
            'menu_id'
        );
    }
}
