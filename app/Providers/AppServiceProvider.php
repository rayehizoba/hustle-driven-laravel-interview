<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Unsplash\HttpClient::init([
            'applicationId'	=> env('UNSPLASH_APP_ID'),
            'secret'	=> env('UNSPLASH_APP_SECRET'),
//            'callbackUrl'	=> 'https://your-application.com/oauth/callback',
            'utmSource' => env('UNSPLASH_APP_NAME')
        ]);
    }
}
