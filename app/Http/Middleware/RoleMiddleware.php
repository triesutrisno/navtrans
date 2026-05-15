<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();
        
        // ambil role user (sesuaikan dengan relasi kamu)
        $userRoles = $user->roles->pluck('role_nama')->toArray();
        //dd($user->roles->pluck('role_nama'));

        // cek apakah ada role yang match
        foreach ($roles as $role) {
            if (in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        //abort(403, 'Akses ditolak');
        return redirect('/dashboard')
        ->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
    }
}
