<?php

namespace Cometa\KeyCloack\Providers;

use Illuminate\Support\ServiceProvider;

class PublisheServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/keyCloack.php' => base_path('config\keyCloack.php'),
        ], 'keyCloack');
        $this->mergeConfigFrom(
            __DIR__.'/../config/auth.php', 'auth'
        );
    }
}
