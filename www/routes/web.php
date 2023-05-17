<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AccountController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::resource('/users','UserController');


Route::middleware(['guest'])->group(function () {
    Route::get('/register',[UserController::class,'create'])->name('register.create');
    Route::post('/register',[UserController::class,'store'])->name('register.store');
    Route::get('/login',[UserController::class,'loginForm'])->name('login.create');
    Route::post('/login',[UserController::class,'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tags', TagController::class)->only(['index','show']);
    Route::resource('categories', CategoryController::class)->only(['index','show']);

    Route::get('/account',[AccountController::class,'index'])->name('account.index');
    Route::get('/deposite',[AccountController::class,'depositeForm'])->name('deposite.form');
    Route::put('/deposite',[AccountController::class,'depositeDo'])->name('deposite.do');

    Route::resource('orders',OrderController::class);
    Route::put('/orders/{order}/confirm',[OrderController::class,'confirm'])->name('orders.confirm');
    Route::put('/orders/{order}/complete',[OrderController::class,'complete'])->name('orders.complete');


    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});

Route::middleware(['admin','auth'])->group(function () {
    Route::resource('admin/tags', TagController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('admin/categories', CategoryController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});