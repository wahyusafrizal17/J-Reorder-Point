<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display monthly stock report
     *
     * @return \Illuminate\Http\Response
     */
    public function monthlyStock(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        $data['month'] = $month;
        
        // Get products with their stock movements for the month
        $data['products'] = Product::with(['stockIn' => function($query) use ($month) {
            $query->whereYear('date', Carbon::parse($month)->year)
                  ->whereMonth('date', Carbon::parse($month)->month);
        }, 'stockOut' => function($query) use ($month) {
            $query->whereYear('date', Carbon::parse($month)->year)
                  ->whereMonth('date', Carbon::parse($month)->month);
        }])->get();

        return view('reports.monthly-stock', $data);
    }

    /**
     * Display expired products
     *
     * @return \Illuminate\Http\Response
     */
    public function expiredProducts()
    {
        // For now, we'll show products with low stock (below reorder point)
        // In a real system, you'd have expiry dates in the products table
        $data['expiredProducts'] = Product::where('current_stock', '<=', DB::raw('reorder_point'))
                                        ->where('current_stock', '>', 0)
                                        ->get();
        
        $data['outOfStock'] = Product::where('current_stock', 0)->get();
        
        return view('reports.expired-products', $data);
    }

    /**
     * Display stock summary
     *
     * @return \Illuminate\Http\Response
     */
    public function stockSummary()
    {
        $data['totalProducts'] = Product::count();
        $data['lowStockProducts'] = Product::where('current_stock', '<=', DB::raw('reorder_point'))
                                         ->where('current_stock', '>', 0)
                                         ->count();
        $data['outOfStockProducts'] = Product::where('current_stock', 0)->count();
        $data['products'] = Product::orderBy('current_stock', 'asc')->get();

        return view('reports.stock-summary', $data);
    }

    /**
     * Display stock movement report
     *
     * @return \Illuminate\Http\Response
     */
    public function stockMovement(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        
        $data['stockIns'] = StockIn::with('product')
                                  ->whereBetween('date', [$startDate, $endDate])
                                  ->orderBy('date', 'desc')
                                  ->get();
        
        $data['stockOuts'] = StockOut::with('product')
                                    ->whereBetween('date', [$startDate, $endDate])
                                    ->orderBy('date', 'desc')
                                    ->get();

        return view('reports.stock-movement', $data);
    }
}
