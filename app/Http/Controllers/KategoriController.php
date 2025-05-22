<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Category::all();   
        
        //cara2
        // $kategoris = DB::table('categories')
        //                 ->select('id','name','created_at','updated_at')
        //                 ->where('name','Books')
        //                 ->get();

        //cara 3
        
        //$kategoris = Category::where('name','Clothing')->get();
        
        return view('kategori.index',['kategoris' => $kategoris]);
    }
    
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
        $data->delete();
        
        return response()->json([
            'status' => 'oke',
            'msg' => 'type data is removed !'
        ], 200);
    }

    // Contoh query untuk pembelajaran
    public function exampleQueries()
    {
        // Contoh query 1 - cara 1
        $categories1 = Category::all();
        
        // Contoh query 2 - cara 2 dengan Query Builder
        $categories2 = DB::table('categories')
                        ->select('id', 'name', 'created_at', 'updated_at')
                        ->where('name', 'Books')
                        ->get();
        
        // Contoh query 3 - cara 3 dengan Eloquent
        $categories3 = Category::where('name', 'Clothing')->get();
        
        // Return data untuk tujuan pembelajaran
        return [
            'eloquent_all' => $categories1,
            'query_builder' => $categories2,
            'eloquent_where' => $categories3
        ];
    }
}
