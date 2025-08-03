<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get inventory statistics
        $data['totalProducts'] = Product::count();
        $data['lowStockProducts'] = Product::where('current_stock', '<=', DB::raw('reorder_point'))
                                         ->where('current_stock', '>', 0)
                                         ->count();
        $data['outOfStockProducts'] = Product::where('current_stock', 0)->count();
        $data['normalStockProducts'] = $data['totalProducts'] - $data['lowStockProducts'] - $data['outOfStockProducts'];

        // Get recent stock movements
        $data['recentStockIns'] = StockIn::with('product')
                                        ->orderBy('created_at', 'desc')
                                        ->limit(5)
                                        ->get();
        
        $data['recentStockOuts'] = StockOut::with('product')
                                          ->orderBy('created_at', 'desc')
                                          ->limit(5)
                                          ->get();

        // Get products that need reorder
        $data['productsNeedReorder'] = Product::where('current_stock', '<=', DB::raw('reorder_point'))
                                             ->orderBy('current_stock', 'asc')
                                             ->limit(10)
                                             ->get();

        // Get monthly statistics
        $currentMonth = Carbon::now()->format('Y-m');
        $data['monthlyStockIns'] = StockIn::whereYear('date', Carbon::now()->year)
                                         ->whereMonth('date', Carbon::now()->month)
                                         ->sum('quantity');
        $data['monthlyStockOuts'] = StockOut::whereYear('date', Carbon::now()->year)
                                           ->whereMonth('date', Carbon::now()->month)
                                           ->sum('quantity');

        return view('home', $data);
    }
}
