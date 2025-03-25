<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // $kategoris = DB::select("select id, name from categories");   
        
        //cara2
        // $kategoris = DB::table('categories')
        //                 ->select('id','name','created_at','updated_at')
        //                 ->where('name','Books')
        //                 ->get();

        //cara 3
        
        $kategoris = Category::where('name','Clothing')->get();
        
        return view('kategori.index',['kategoris' => $kategoris]);
    }
}
