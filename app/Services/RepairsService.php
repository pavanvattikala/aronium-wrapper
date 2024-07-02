<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Services\Service;

class RepairsService extends Service
{
    public function repairs_by_date($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate)->endOfDay();

        $repairs = Document::join('DocumentItem', 'Document.id', '=', 'DocumentItem.DocumentId')
            ->join('Product', 'Product.id', '=', 'DocumentItem.ProductId')
            ->where('Product.ProductGroupId', 17)
            ->whereBetween('Document.DateCreated', [$startDate, $endDate])
            ->selectRaw('DATE(Document.DateCreated) AS Date, SUM(DocumentItem.Total) AS TotalSum')
            ->groupBy(DB::raw('DATE(Document.DateCreated)'))
            ->get();

        return $repairs;
    }
}
