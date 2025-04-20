<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use View;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $menus = Menu::all();
        $parentMenus = $menus->whereNull('parent_id');
        $childMenus = $menus->whereNotNull('parent_id');

        View::share('parentMenus', $parentMenus);
        View::share('childMenus', $childMenus);
    }
}
