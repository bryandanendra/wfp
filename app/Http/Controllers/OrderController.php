<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FoodOrder;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $foodOrders = DB::table('food_orders')
            ->join('orders', 'food_orders.order_id', '=', 'orders.id')
            ->join('foods', 'food_orders.food_id', '=', 'foods.id')
            ->select(
                'orders.id',
                'orders.tanggal',
                'orders.status',
                DB::raw('SUM(food_orders.quantity * food_orders.harga_jual) as total'),
                DB::raw('COUNT(DISTINCT food_orders.food_id) as total_menu'),
                DB::raw('SUM(food_orders.quantity) as total_items')
            )
            ->groupBy('orders.id', 'orders.tanggal', 'orders.status')
            ->orderBy('orders.tanggal', 'desc')
            ->get();

        return view('admin.orders', ['orders' => $foodOrders]);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderDetails = FoodOrder::where('order_id', $id)
            ->join('foods', 'food_orders.food_id', '=', 'foods.id')
            ->select('foods.name', 'food_orders.quantity', 'food_orders.harga_jual')
            ->get();

        return view('admin.order_detail', [
            'order' => $order,
            'orderDetails' => $orderDetails
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3'
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function reports()
    {
        $monthlySales = Order::selectRaw('MONTH(tanggal) as month, SUM(grand_total) as total_sales, COUNT(*) as transaction_count')
            ->whereYear('tanggal', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        $categorySales = Order::join('food_orders', 'orders.id', '=', 'food_orders.order_id')
            ->join('foods', 'food_orders.food_id', '=', 'foods.id')
            ->join('categories', 'foods.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, SUM(food_orders.harga_jual * food_orders.quantity) as total_sales')
            ->groupBy('categories.name')
            ->orderBy('total_sales', 'desc')
            ->get();
            
        $salesSummary = Order::selectRaw('MONTH(tanggal) as month, SUM(grand_total) as total_sales, COUNT(*) as transaction_count, AVG(grand_total) as average_transaction')
            ->whereYear('tanggal', date('Y'))
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(3)
            ->get();
            
        // Get best selling product for each month
        $bestSellingProducts = [];
        foreach ($salesSummary as $summary) {
            $bestProduct = Order::join('food_orders', 'orders.id', '=', 'food_orders.order_id')
                ->join('foods', 'food_orders.food_id', '=', 'foods.id')
                ->selectRaw('foods.name, SUM(food_orders.quantity) as total_qty')
                ->whereMonth('orders.tanggal', $summary->month)
                ->whereYear('orders.tanggal', date('Y'))
                ->groupBy('foods.name')
                ->orderBy('total_qty', 'desc')
                ->first();
                
            $bestSellingProducts[$summary->month] = $bestProduct ? $bestProduct->name : '-';
        }
        
        return view('admin.reports', [
            'monthlySales' => $monthlySales,
            'categorySales' => $categorySales,
            'salesSummary' => $salesSummary,
            'bestSellingProducts' => $bestSellingProducts
        ]);
    }

    public function dashboard()
    {
        $totalRevenue = DB::table('food_orders')->sum(DB::raw('quantity * harga_jual'));
        $totalOrders = Order::count();
        $totalMenu = Food::count();
        
        $recentOrders = DB::table('orders')
            ->join('food_orders', 'orders.id', '=', 'food_orders.order_id')
            ->select(
                'orders.id',
                'orders.tanggal',
                'orders.status',
                DB::raw('SUM(food_orders.quantity * food_orders.harga_jual) as total')
            )
            ->groupBy('orders.id', 'orders.tanggal', 'orders.status')
            ->orderBy('orders.tanggal', 'desc')
            ->limit(5)
            ->get();
            
        return view('admin.dashboard', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalMenu' => $totalMenu,
            'recentOrders' => $recentOrders
        ]);
    }
} 