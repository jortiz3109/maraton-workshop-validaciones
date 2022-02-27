<?php

namespace App\Listeners;

use App\Events\ProductVisited;
use App\Models\ProductVisit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use UAParser\Parser;

class AddProductVisit
{
    public function handle(ProductVisited $event): void
    {
        $userAgent = Parser::create()->parse($event->userAgent);

        ProductVisit::create([
            'product_id' => $event->product->getRouteKey(),
            'browser' => $userAgent->ua->toString(),
            'ip' => $event->ip,
            'os' => $userAgent->os->toString()
        ]);
    }
}
