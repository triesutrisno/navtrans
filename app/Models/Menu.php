<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menu'; // karena bukan 'menus'
    protected $primaryKey = 'menu_id'; // primary ke untuk tabel menu
    protected $fillable = [
        'menu_id',
        'menu_nama',
        'menu_link',
        'menu_keterangan',
        'menu_parent',
        'menu_sort',
        'menu_status',
        'menu_type',
    ];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'menurole',
            'menu_id',
            'role_nama'
        );
    }

    public function children()
    {
        return $this->hasMany(
            Menu::class, 
            'menu_parent',
            'menu_id'
        )
        ->where('menu_status', '1')
        ->whereNull('deleted_at')
        ->orderBy('menu_sort');
    }
}
