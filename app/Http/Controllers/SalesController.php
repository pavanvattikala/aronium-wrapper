<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index()
    {
        return view('analytics.index');
    }

    public function repairs(Request $request)
    {

        $repairs = null;
        // if get Request 
        if ($request->isMethod('get')) {
            return view('analytics.repairs', compact('repairs'));
        } else {
            $startDate = $request->startDate;
            $endDate = $request->endDate;


            //               SELECT 
            //       DATE(Document.DateCreated) AS Date, 
            //       SUM(DocumentItem.Total) AS totalSum
            //   FROM 
            //       Document
            //   INNER JOIN 
            //       DocumentItem ON DocumentItem.DocumentId = Document.id
            //   INNER JOIN 
            //       Product ON Product.id = DocumentItem.ProductId
            //   WHERE 
            //       Product.ProductGroupId = 17
            //       AND Document.DateCreated BETWEEN '${startDate}' AND '${endDate}'
            //   GROUP BY 
            //       DATE(Document.DateCreated)

            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate)->endOfDay();

            $repairs = Document::join('DocumentItem', 'Document.id', '=', 'DocumentItem.DocumentId')
                ->join('Product', 'Product.id', '=', 'DocumentItem.ProductId')
                ->where('Product.ProductGroupId', 17)
                ->whereBetween('Document.DateCreated', [$startDate, $endDate])
                ->selectRaw('DATE(Document.DateCreated) AS Date, SUM(DocumentItem.Total) AS TotalSum')
                ->groupBy(DB::raw('DATE(Document.DateCreated)'))
                ->get();
        }
        return view('analytics.repairs', compact('repairs'));
    }

    public function sales(Request $request)
    {

        $sales = null;
        // if get Request 
        if ($request->isMethod('get')) {
            return view('analytics.sales', compact('sales'));
        } else {
            $startDate = $request->startDate;
            $endDate = $request->endDate;


            //               SELECT 
            //       DATE(Document.DateCreated) AS Date, 
            //       SUM(DocumentItem.Total) AS totalSum
            //   FROM 
            //       Document
            //   INNER JOIN 
            //       DocumentItem ON DocumentItem.DocumentId = Document.id
            //   INNER JOIN 
            //       Product ON Product.id = DocumentItem.ProductId
            //   WHERE 
            //       Product.ProductGroupId = 17
            //       AND Document.DateCreated BETWEEN '${startDate}' AND '${endDate}'
            //   GROUP BY 
            //       DATE(Document.DateCreated)

            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate)->endOfDay();

            $sales = Document::whereBetween('DateCreated', [$startDate, $endDate])
                ->selectRaw('DATE(DateCreated) AS Date, SUM(total) AS TotalSum')
                ->groupBy(DB::raw('DATE(DateCreated)'))
                ->get();
        }
        return view('analytics.sales', compact('sales'));
    }
}