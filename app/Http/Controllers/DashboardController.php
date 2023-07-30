<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Mobil;
use App\Models\Rent_log;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $categoryCount = Category::count();
        $mobilCount = Mobil::count();
        $rentalCount = Rent_log::count();
        return view('dashboard', ['user_count' => $userCount, 'category_count' => $categoryCount, 
        'mobil_count' => $mobilCount, 'rent_count'=> $rentalCount ]);
    }
}
