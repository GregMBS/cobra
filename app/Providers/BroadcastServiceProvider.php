<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $bc = new Broadcast();
        $bc->routes();

        require base_path('routes/channels.php');
    }
}
