<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use App\Services\RepairsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{

    protected $salesService;

    protected $repairsService;

    public function __construct(SalesService $salesService, RepairsService $repairsService)
    {
        $this->salesService = $salesService;
        $this->repairsService = $repairsService;
    }

    public function index()
    {
        return view('analytics.index');
    }


    public function by_date(Request $request)
    {

        // initialize analytics data
        $analytics_data = null;

        // get type fom url parameter
        $type = $request->type;

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
                $analytics_data = $this->repairsService->repairs_by_date($startDate, $endDate);
            } else {
                $analytics_data = $this->salesService->sales_by_date($startDate, $endDate);
            }
        }
        return view('analytics.by_date', compact('analytics_data', 'startDate', 'endDate', 'type'));
    }
}
