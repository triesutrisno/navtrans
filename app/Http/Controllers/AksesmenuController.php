<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AksesmenuController extends Controller
{
    /**
     * ambil date menu by user login.
     */
    public static function getMenuByUser()
    {
        $user = Auth::user();

        return Menu::whereHas('roles', function ($q) use ($user) {
            $q->whereIn('roles.id', $user->roles->pluck('id'));
        })->orderBy('urutan')->get();
    }
}
