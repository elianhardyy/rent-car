<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticating']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'registerProcess']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth', 'admin');
Route::get('home', [HomeController::class, 'home'])->middleware('auth', 'peminjam');

Route::get('katalog', [KatalogController::class, 'index']);

Route::get('users', [UsersController::class, 'index']);
Route::get('users-add', [UsersController::class, 'add']);
Route::post('users-add', [UsersController::class, 'store']);
Route::get('users-edit/{slug}', [UsersController::class, 'edit']);
Route::put('users-edit/{slug}', [UsersController::class, 'update']);
Route::get('users-delete/{slug}', [UsersController::class, 'delete']);

Route::get('kategori', [CategoryController::class, 'index']);
Route::get('category-add', [CategoryController::class, 'add']);
Route::post('category-add', [CategoryController::class, 'store']);
Route::get('category-edit/{slug}', [CategoryController::class, 'edit']);
Route::put('category-edit/{slug}', [CategoryController::class, 'update']);
Route::get('category-delete/{slug}', [CategoryController::class, 'delete']);

Route::get('mobil', [MobilController::class, 'index']);
Route::get('mobil-add', [MobilController::class, 'add']);
Route::post('mobil-add', [MobilController::class, 'store']);
Route::get('mobil-edit/{slug}', [MobilController::class, 'edit']);
Route::post('mobil-edit/{slug}', [MobilController::class, 'update']);
Route::get('mobil-delete/{slug}', [MobilController::class, 'delete']);

Route::get('datarental', [RentalController::class, 'index']);
Route::get('rent-edit/{slug}',[RentalController::class,'edit'])->name('rent-edit');
Route::post('rent-add',[RentalController::class,'store']);
Route::put('rent-edit/{slug}/{id}',[RentalController::class,'update'])->name('rent-update');
Route::get('sewa',[RentalController::class,'detail'])->name('detail-car');
Route::get('/date-range-filter',[RentalController::class,'filter'])->name('filter-rent');