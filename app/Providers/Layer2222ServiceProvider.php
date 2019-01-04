<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class Layer2222ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        require_once app_path().'/Helper/Layer2222.php';
    }
}