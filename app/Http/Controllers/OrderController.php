<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\FoodOrder;
use App\Models\Food;
use App\Models\Member;
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

    public function create()
    {
        $foods = Food::all();
        $members = Member::all();
        return view('admin.order_create', [
            'foods' => $foods,
            'members' => $members
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Validasi data
            $request->validate([
                'tanggal' => 'required|date',
                'status' => 'required|integer|between:0,3',
                'member_id' => 'nullable|exists:members,id',
                'food_ids' => 'required|array',
                'food_ids.*' => 'exists:foods,id',
                'quantities' => 'required|array',
                'quantities.*' => 'integer|min:1',
            ]);
            
            // Buat order baru
            $order = new Order();
            $order->tanggal = $request->tanggal;
            $order->status = $request->status;
            $order->member_id = $request->member_id;
            $order->grand_total = 0; // Akan dihitung nanti
            $order->save();
            
            $grandTotal = 0;
            
            // Simpan item menu yang dipesan
            for ($i = 0; $i < count($request->food_ids); $i++) {
                if (isset($request->food_ids[$i]) && isset($request->quantities[$i]) && $request->quantities[$i] > 0) {
                    $foodId = $request->food_ids[$i];
                    $quantity = $request->quantities[$i];
                    
                    $food = Food::find($foodId);
                    $price = $food->price;
                    
                    // Attach dengan relasi many-to-many
                    $order->foods()->attach($foodId, [
                        'quantity' => $quantity,
                        'harga_jual' => $price
                    ]);
                    
                    $grandTotal += ($price * $quantity);
                }
            }
            
            // Update grand total
            $order->grand_total = $grandTotal;
            $order->save();
            
            DB::commit();
            
            return redirect()->route('orders.index')
                ->with('success', 'Pesanan berhasil dibuat');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    /**
     * Get edit form for Ajax request (Type A).
     */
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Order::find($id);
        $members = \App\Models\Member::all();
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('orders.getEditForm', compact('data', 'members'))->render()
        ], 200);
    }
    
    /**
     * Get edit form for Ajax request (Type B).
     */
    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Order::find($id);
        $members = \App\Models\Member::all();
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('orders.getEditFormB', compact('data', 'members'))->render()
        ], 200);
    }
    
    /**
     * Update order data via Ajax without page refresh.
     */
    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Order::find($id);
        
        if ($request->has('tanggal')) {
            $data->tanggal = $request->tanggal;
        }
        if ($request->has('status')) {
            $data->status = $request->status;
        }
        if ($request->has('member_id')) {
            $data->member_id = $request->member_id;
        }
        if ($request->has('type')) {
            $data->type = $request->type;
        }
        
        $data->save();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'Order data is up-to-date !'
        ], 200);
    }
    
    /**
     * Delete order data via Ajax without page refresh.
     */
    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Order::find($id);
        
        // Hapus detail order terlebih dahulu
        $data->foods()->detach();
        
        $data->delete();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'Order data is removed !'
        ], 200);
    }
} 