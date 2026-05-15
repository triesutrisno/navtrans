<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();

               $menus = Menu::with([
                    'children' => function ($child) use ($user) {
                        $child->where('menu_status', '1')
                            ->whereNull('deleted_at')
                            ->whereHas('roles', function ($q) use ($user) {
                                $q->whereIn('role.role_nama', function ($query) use ($user) {
                                    $query->select('role_nama')
                                        ->from('userrole')
                                        ->where('user_id', $user->id);

                                });
                            })
                            ->orderBy('menu_sort');

                    }
                ])
                ->whereNull('menu_parent')
                ->where('menu_status', '1')
                ->whereNull('deleted_at')
                ->whereHas('roles', function ($q) use ($user) {
                    $q->whereIn('role.role_nama', function ($query) use ($user) {
                        $query->select('role_nama')
                            ->from('userrole')
                            ->where('user_id', $user->id);
                    });
                })
                ->orderBy('menu_sort')
                ->get();

                $view->with('menus', $menus);
            }
        });  
    }
}
