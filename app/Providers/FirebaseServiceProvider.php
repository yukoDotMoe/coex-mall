<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Firebase::class, function ($app) {
            return (new Factory)
                ->withServiceAccount('serviceAccount.json')
                ->withDatabaseUri('https://leuleu-12458-default-rtdb.asia-southeast1.firebasedatabase.app/')
                ->withProjectId('leuleu-12458')
                ->createAuth();
        });
    }
}
