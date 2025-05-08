<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriAdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', ['categories' => $categories]);
    }
    
    public function create()
    {
        return view('admin.category_create');
    }
    
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'nullable'
        // ]);
        
        // Category::create([
        //     'name' => $request->name,
        //     'description' => $request->description
        // ]);
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Kategori ' . $request->name . ' berhasil ditambahkan');
    }
    
    public function edit(Category $category)
    {
        return view('admin.category_edit', ['category' => $category]);
    }
    
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);
        
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }
    
    public function destroy(Category $category)
    {
        // Periksa apakah kategori digunakan oleh makanan
        if ($category->foods->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Kategori tidak dapat dihapus karena digunakan oleh beberapa produk');
        }
        
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
} 