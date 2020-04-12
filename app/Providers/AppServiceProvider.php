<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

      protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('layout.app', function($view) {
            $setting = DB::table('contactinfos')->first();
            $social = DB::table('social_media')->first();
            $category = DB::table('categories')
            ->where('parent_id',0)
            ->get();
            $view->with(compact('setting','social','category'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
