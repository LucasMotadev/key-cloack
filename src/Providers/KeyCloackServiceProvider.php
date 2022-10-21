<?php

namespace Cometa\KeyCloack\Providers;

use Cometa\KeyCloack\KeyCloackGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class KeyCloackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $key = __DIR__.'/../config/keycloak.php';
        $value = base_path("config/keyCloack.php");
        $this->publishes([$key => $value], 'config');
        $this->mergeConfigFrom($value, 'keycloak');
    }

     public function register()
     {
         Auth::extend('keycloak', function ($app, $name, array $config) {
             return new KeyCloackGuard(Auth::createUserProvider($config['provider']), $app->request);
         });
     }
}
