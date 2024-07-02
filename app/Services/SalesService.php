<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Services\Service;

class SalesService extends Service
{
    public function sales_by_date($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate)->endOfDay();

        $sales = Document::whereBetween('DateCreated', [$startDate, $endDate])
            ->selectRaw('DATE(DateCreated) AS Date, SUM(total) AS TotalSum')
            ->groupBy(DB::raw('DATE(DateCreated)'))
            ->get();

        return $sales;
    }
}
