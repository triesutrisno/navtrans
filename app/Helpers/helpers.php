<?php

use Illuminate\Support\Facades\DB;

function hasMenuAccess($menuId, $access)
{
    $user = auth()->user();

    if (!$user) {
        return false;
    }

    $roles = DB::table('userrole')
        ->where('user_id', $user->id)
        ->pluck('role_nama');

    return DB::table('menurole')
        ->where('menu_id', $menuId)
        ->whereIn('role_nama', $roles)
        ->where($access, '1')
        ->exists();
}
