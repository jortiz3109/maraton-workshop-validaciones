<?php

namespace App\Providers;

use App\Events\ProductVisited;
use App\Listeners\AddProductVisit;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        ProductVisited::class => [
            AddProductVisit::class,
        ]
    ];
}
