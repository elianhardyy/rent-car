<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Category;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::all();
        return view('mobil',['mobils'=>$mobils]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('mobil-add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|unique:mobils|max:255',
            'nama_mobil' => 'required',
            'images'=>'required',
            'harga'=>'required',
            'categories'=>'required'
        ]);

        $newName = '';
        if($request->file('images')){
            $extension = $request->file('images')->getClientOriginalExtension();
            $newName = $request->nopol.'-'.now()->timestamp.'.'.$extension;
            $request->file('images')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $mobil = Mobil::create($request->all());
        $mobil->categories()->sync($request->categories);
        return redirect('mobil')->with('status', 'Katalog Berhasil Ditambahkan');
    }

    public function edit($slug)
    {
        $mobil = Mobil::where('slug', $slug)->first();
        $categories = Category::all();
        return view('mobil-edit', ['categories' => $categories, 'mobil' =>$mobil]);
    }

    public function update(Request $request, $slug)
    {
        if($request->file('images')){
            $extension = $request->file('images')->getClientOriginalExtension();
            $newName = $request->nopol.'-'.now()->timestamp.'.'.$extension;
            $request->file('images')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }
    
        
        $mobil = Mobil::where('slug', $slug)->first();
        $mobil ->update($request->all());

        if($request->categories){
            $mobil->categories()->sync($request->categories);
        }

        return redirect('mobil')->with('status', 'Katalog Berhasil Diubah');
    }

    public function delete($slug)
    {
        $mobil = Mobil::where('slug', $slug)->first();
        $mobil->delete();
        return redirect('mobil')->with('status', 'Data Mobil Berhasil Dihapus');
    }

}
