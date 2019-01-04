<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SearchFieldsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once app_path().'/Helper/SearchFieldsHelper.php';

    }
}
