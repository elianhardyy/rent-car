<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', ['users'=>$users]);
    }

    public function add()
    {
        $roles = Role::all();
        return view('users-add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255'
        ]);

        $data =[
            'username' => $request->username,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
            'role_id' => $request->roles,
        ];
        User::create($data);
        //$users = User::create($request->all());
        return redirect('users')->with('status', 'Kategori Berhasil Ditambahkan');
    }

    public function edit($slug)
    {
        $users = User::where('slug', $slug)->first();
        return view('users-edit', ['users' => $users]);
    }

    public function update(Request $request, $slug)
    {
        $users = User::where('slug',$slug)->first();
        $users->slug = null;
        $users->update($request->all());
        return redirect('users')->with('status', 'Users Berhasil Diupdate');
    }

    public function delete($slug)
    {
        $users = User::where('slug', $slug)->first();
        $users->delete();
        return redirect('users')->with('status', 'Users Berhasil Dihapus');
    }
}