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
}
