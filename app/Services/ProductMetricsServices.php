<?php

namespace App\Services;

use App\Models\ProductVisit;
use Illuminate\Database\Eloquent\Collection;

class ProductMetricsServices
{
    public function visits(): Collection
    {
        return ProductVisit::select('product_id')->selectRaw('count(product_id) as visits')
            ->whereDate('created_at', '>=', now()->subWeek() )
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderBy('visits', 'DESC')
            ->limit(5)
            ->get();
    }
}
