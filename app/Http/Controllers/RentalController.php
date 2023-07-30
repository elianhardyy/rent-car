<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rent_log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class RentalController extends Controller
{
    public function index()
    {   
        $datarental = Rent_log::with('user')->with('mobil')->orderBy('created_at','desc')->get();
        $users = User::where('role_id',2)->get();
        return view('datarental',compact('datarental','users'));
    }
    public function detail(Request $request)
    {
        $param = $request->get('mobil');
        $mobil = Mobil::where('slug',$param)->first();
        return view('rent',["mobil"=>$mobil]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'=>'required',
            'mobil_id'=>'required',
            'rent_date'=>'required',
            'KTP'=>'required|image',
            'SIM'=>'required|image',
            'total'=>'required',
        ]);
        $validated['KTP'] = $request->file('KTP')->store('ktp'); 
        $validated['SIM'] = $request->file('SIM')->store('sim'); 
        Rent_log::create($validated);
        return redirect('/katalog');
    }
    public function edit($slug)
    {
            $slugcrypt = Crypt::decrypt($slug);
            $rent = Rent_log::with('user')->with('mobil')->where('slug',$slugcrypt)->first();
            return view('rental-edit',["rent"=>$rent]);
    }
    public function update(Request $request,$slug,$id)
    {
        $validate = $request->validate([
            'return_date'=>'required'
        ]);
        Rent_log::where('id',$id)->update([
            'return_date'=>$validate['return_date'],
        ]);
        Mobil::where('slug',$slug)->update([
            'status'=>'Dipinjam'
        ]);
        return redirect('/datarental');
    }
    public function filter(Request $request)
    {
       $category = $request->category_date_select;
       $from = $request->from;
       $to = $request->to;
       $datarental = Rent_log::with('user')->with('mobil')->orderBy('created_at','desc')->get();
       $users = User::where('role_id',2)->get();
        switch ($category) {
            case 'return_date':
                $datarental = Rent_log::with('user')->with('mobil')->whereBetween('return_date',[$from,$to])->orderBy('created_at','desc')->get();
                $users = User::where('role_id',2)->get();
                return view('rent-filter',compact('datarental','users','from','to'));
                break;
            case 'rent_date':
                $datarental = Rent_log::with('user')->with('mobil')->whereBetween('rent_date',[$from,$to])->orderBy('created_at','desc')->get();
                $users = User::where('role_id',2)->get();
                return view('rent-filter',compact('datarental','users','from','to'));
                break;
            case 'created_at':
                $datarental = Rent_log::with('user')->with('mobil')->whereBetween('created_at',[$from,$to])->orderBy('created_at','desc')->get();
                $users = User::where('role_id',2)->get();
                return view('rent-filter',compact('datarental'.'users','from','to'));
                break;
            case 'return_user_date':
                $rentuserdate = $request->return_user_date;
                $users = User::where('role_id',2)->get();
                $datarental = Rent_log::with('user')->with('mobil')->where('user_id',$rentuserdate)->whereBetween('return_date',[$from,$to])->orderBy('created_at','desc')->get();
                
                return view('rent-filter',compact('datarental','users','from','to'));
                break;
            }
                        
            return view('rent-filter',['datarental'=>$datarental,'users'=>$users,'from'=>$from,'to'=>$to]);
        } 
        public function delete(Rent_log $rent, $id)
        {
           Rent_log::where('id',$id)->delete();
           Storage::delete($rent->KTP);
        }
}
