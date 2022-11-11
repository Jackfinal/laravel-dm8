<?php

namespace LaravelDm8\Dm8;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use LaravelDm8\Dm8\Auth\OracleUserProvider;
use LaravelDm8\Dm8\Connectors\DmConnector as Connector;

class Dm8ServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot Oci8 Provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dm.php' => config_path('dm.php'),
        ], 'dm');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists(config_path('dm.php'))) {
            $this->mergeConfigFrom(config_path('dm.php'), 'database.connections');
        } else {
            $this->mergeConfigFrom(__DIR__.'/../config/dm.php', 'database.connections');
        }

        Connection::resolverFor('dm', function ($connection, $database, $prefix, $config) {
            if (isset($config['dynamic']) && ! empty($config['dynamic'])) {
                call_user_func_array($config['dynamic'], [&$config]);
            }

            $connector = new Connector();
            $connection = $connector->connect($config);
            $db = new Dm8Connection($connection, $database, $prefix, $config);
            
            return $db;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [];
    }
}
