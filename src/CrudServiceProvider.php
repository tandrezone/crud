<?php

namespace xbugs\crud;

use xbugs\crud\Commands\CreateCrud;
use Illuminate\Support\ServiceProvider;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //dd(__DIR__);
        $this->loadViewsFrom(__DIR__."/views", "crud");
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateCrud::class
            ]);
        }
    }
}
