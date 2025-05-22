<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Exception;

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
        try {
            // Periksa apakah kategori digunakan oleh makanan
            if ($category->foods->count() > 0) {
                return redirect()->route('categories.index')->with('error', 'Kategori tidak dapat dihapus karena digunakan oleh beberapa produk');
            }
            
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Terjadi kesalahan saat menghapus kategori: ' . $e->getMessage());
        }
    }
    
    // Ajax Methods
    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('kategori.getEditForm', compact('data'))->render()
        ], 200);
    }
    
    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        
        return response()->json([
            'status' => 'oke',
            'msg' => view('kategori.getEditFormB', compact('data'))->render()
        ], 200);
    }
    
    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        $data->name = $request->name;
        if ($request->has('description')) {
            $data->description = $request->description;
        }
        $data->save();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'type data is up-to-date !'
        ], 200);
    }
    
    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Category::find($id);
        
        // Periksa jika kategori digunakan oleh makanan
        if ($data->foods->count() > 0) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Kategori tidak dapat dihapus karena digunakan oleh beberapa produk'
            ], 422);
        }
        
        $data->delete();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ], 200);
    }
} 