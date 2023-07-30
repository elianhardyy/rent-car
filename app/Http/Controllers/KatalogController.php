<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Category;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if($request->category || $request->nama_mobil){
            $katalog = Mobil::where('nama_mobil', 'like','%'.$request->nama_mobil.'%')
            ->WhereHas('categories', function($q) use($request) {$q->where('categories.id', 
            $request->category);})->get();
        }
        else{
        $katalog = Mobil::all();}
        return view('katalog', ['katalog'=> $katalog, 'categories'=>$categories]);
    }
}