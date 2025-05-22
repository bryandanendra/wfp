<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        return view('food.index',['foods' => $foods]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('food.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'nutritions_fact' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $food = Food::create($validated);
        
        return redirect()->route('food.index')
            ->with('success', 'Menu ' . $food->name . ' berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('food.show', ['food' => $food]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        $categories = Category::all();
        return view('food.edit', [
            'food' => $food,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'nutritions_fact' => 'required',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $food->update($validated);
        
        return redirect()->route('food.index')
            ->with('success', 'Menu ' . $food->name . ' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        try {
            $foodName = $food->name;
            $food->delete();
            
            return redirect()->route('food.index')
                ->with('success', 'Menu ' . $foodName . ' berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('food.index')
                ->with('error', 'Terjadi kesalahan saat menghapus menu: ' . $e->getMessage());
        }
    }

    /**
     * Storing food item into database (dikelas).
     */
    public function storing(Request $request)
    {
        $food = new Food();
        $food->name = $request->name;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->nutritions_fact = $request->nutritions_fact;
        $food->category_id = $request->category_id;
        $food->save();
        return redirect()->route('food.index')->with('success', 'Data ' . $request->name . ' berhasil ditambahkan');
    }
    
    /**
     * Get edit form for Ajax request (Type A).
     */
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Food::find($id);
        $categories = Category::all();
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('food.getEditForm', compact('data', 'categories'))->render()
        ], 200);
    }
    
    /**
     * Get edit form for Ajax request (Type B).
     */
    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Food::find($id);
        $categories = Category::all();
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('food.getEditFormB', compact('data', 'categories'))->render()
        ], 200);
    }
    
    /**
     * Update food data via Ajax without page refresh.
     */
    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Food::find($id);
        $data->name = $request->name;
        $data->price = $request->price;
        if ($request->has('description')) {
            $data->description = $request->description;
        }
        if ($request->has('nutritions_fact')) {
            $data->nutritions_fact = $request->nutritions_fact;
        }
        if ($request->has('category_id')) {
            $data->category_id = $request->category_id;
        }
        $data->save();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'Food data is up-to-date !'
        ], 200);
    }
    
    /**
     * Delete food data via Ajax without page refresh.
     */
    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Food::find($id);
        
        // Periksa jika makanan digunakan dalam order
        if ($data->orders()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Food tidak dapat dihapus karena digunakan dalam beberapa order'
            ], 422);
        }
        
        $data->delete();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'Food data is removed !'
        ], 200);
    }
}
