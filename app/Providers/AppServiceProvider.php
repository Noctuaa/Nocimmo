<?php

namespace App\Providers;

use App\RealEstate;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191); 
        // get the last two real estate and display in the footer
        View::composer('layouts.app', function($view){
            $lastEstates = RealEstate::latest()->limit(2)->get();
            $view->with('lastEstates', $lastEstates);
        });
    }
}
