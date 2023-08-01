<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Rent_log;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
//use PDF;
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
    public function add(Request $request)
    {
        $mobil = $request->input('mobil_id');
        $user = $request->input('user_id');
        return view('multi-rent',compact('mobil','user'));
    }
    public function multirent(Request $request)
    {
        $mobil = $request->input('mobil_id');
        $user = $request->input('user_id');
        $ktp = $request->file('KTP')->store('ktp');
        $sim = $request->file('SIM')->store('sim'); 
        $rentdate = $request->input('rent_date');

        // $validated['KTP'] = $request->file('KTP')->store('ktp'); 
        // $validated['SIM'] = $request->file('SIM')->store('sim'); 
        // $validated = $request->validate([
        //     'user_id'=>'required',
        //     'mobil_id'=>'required',
        //     'rent_date'=>'required',
        //     'KTP'=>'required|image',
        //     'SIM'=>'required|image',
        // ]);

        foreach ($mobil as $key => $value) {
            $data = [
                'mobil_id'=>$value,
                'user_id'=>$user[$key],
                'KTP'=>$ktp,
                'SIM'=>$sim,
                'rent_date'=>$rentdate
            ];
            Rent_log::create($data);
        }
        return redirect('/katalog');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'=>'required',
            'mobil_id'=>'required',
            'rent_date'=>'required',
            'KTP'=>'required|image',
            'SIM'=>'required|image',
        ]);
        $validated['KTP'] = $request->file('KTP')->store('ktp'); 
        $validated['SIM'] = $request->file('SIM')->store('sim'); 
        Rent_log::create($validated);
        return redirect('/katalog');
    }
    public function edit($slug)
    {
            
            $rent = Rent_log::with('user')->with('mobil')->where('slug',$slug)->first();
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
            case 'return_user_date':
                $rentuserdate = $request->return_user_date;
                $users = User::where('role_id',2)->get();
                $datarental = Rent_log::with('user')->with('mobil')->where('user_id',$rentuserdate)->whereBetween('return_date',[$from,$to])->orderBy('created_at','desc')->get();
                
                return view('rent-filter',compact('datarental','users','from','to'));
                break;
            }
                        
            return view('rent-filter',['datarental'=>$datarental,'users'=>$users,'from'=>$from,'to'=>$to]);
        } 
        public function delete($slug)
        {
           Mobil::where('slug',$slug)->update([
            'status'=>'Tersedia',
           ]);
           return redirect('datarental')->with('status','Data Rental Berhasil Dikembalikan');
        }
        public function cetakpdf(Request $request)
        {   $categorydate = $request->category_date_select_cetak;
            
            $from = $request->from_cetak;
            $to = $request->to_cetak;
            
            switch ($categorydate) {
                case 'return_date':
                    $datarental = Rent_log::with('user')->with('mobil')->whereBetween('return_date',[$from,$to])->orderBy('created_at','desc')->get();
                    $users = User::where('role_id',2)->get();
                    $title = 'Mobil Kembali';
                    $pdf = Pdf::loadView('cetak-rental',compact('datarental','users','from','to','title'));
                    return $pdf->stream('cetak-return-date');
                    break;
                case 'rent_date':
                    $datarental = Rent_log::with('user')->with('mobil')->whereBetween('rent_date',[$from,$to])->orderBy('created_at','desc')->get();
                    $users = User::where('role_id',2)->get();
                    $title = 'Mobil Pinjam';
                    $pdf = Pdf::loadView('cetak-rental',compact('datarental','users','from','to','title'));
                    return $pdf->stream('cetak-rent-date');
                    break;
                case 'return_user_date':
                    $rentuserdate = $request->return_user_date_cetak;
                    $users = User::where('role_id',2)->get();
                    $rental = Rent_log::with('user')->with('mobil')->where('user_id',$rentuserdate)->whereBetween('return_date',[$from,$to])->orderBy('created_at','desc')->get();
                    $title = 'Mobil Kembali dan Pengguna';
                    $pdf = Pdf::loadView('cetak-rental',compact('datarental','users','from','to','title'));
                    return $pdf->stream('cetak-rental-user');
                    break;
                }



        }
}
