<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{

    public function index()
    {
        return view('analytics.index');
    }

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

    public function by_date(Request $request)
    {

        // initialize analytics data
        $analytics_data = null;

        // get type fom url parameter
        $type = $request->type;

        $allowd_types = ['repairs', 'sales'];

        // check if type is allowed
        if (!in_array($type, $allowd_types)) {
            // 404 page
            abort(404);
        }

        //  if get request return view
        if ($request->isMethod('get')) {
            return view('analytics.by_date', compact('analytics_data', 'type'));
        } else {
            // POST request
            $startDate = $request->startDate;
            $endDate = $request->endDate;

            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate)->endOfDay();

            // check if route has repair or sales
            if ($type == 'repairs') {
                $analytics_data = $this->repairs_by_date($startDate, $endDate);
            } else {
                $analytics_data = $this->sales_by_date($startDate, $endDate);
            }
        }
        return view('analytics.by_date', compact('analytics_data', 'startDate', 'endDate', 'type'));
    }
}
