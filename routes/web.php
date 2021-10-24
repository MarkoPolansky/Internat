<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['middleware' => ['auth', 'role:internatista'],],function (){
    Route::get('/dashboard',[\App\Http\Controllers\User\DashboardController::class,'index'])->name('dashboard');

    Route::post('/vychadzky/odchod',[\App\Http\Controllers\User\OutingController::class,'odchod'])->name('vychadzky.odchod');




});


Route::group(['middleware' => ['auth', 'role:vychovavatel'], 'as' => 'admin.', 'prefix' => 'admin','namespace' => 'admin'],function (){
    Route::get('/internatnici',[\App\Http\Controllers\Admin\UserController::class,'internatnici'])->name('internatnici');
    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');

    Route::get('/vychadzky',[\App\Http\Controllers\Admin\OutingController::class,'index'])->name('vychadzky');
    Route::post('/vychadzky/prichod',[\App\Http\Controllers\Admin\OutingController::class,'prichod'])->name('vychadzky.prichod');


    Route::get('/hodnotenie/create',[\App\Http\Controllers\Admin\RattingController::class, 'create'])->name('hodnotenie.create');
    Route::post('/hodnotenie',[\App\Http\Controllers\Admin\RattingController::class, 'update'])->name('hodnotenie.update');


});


Route::group(['middleware' => ['auth', 'role:Super-Admin'], 'as' => 'admin.', 'prefix' => 'admin','namespace' => 'admin'],function (){
    Route::get('/users',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('users');

});



//Route::get('/dashboard', function () {
//    return Inertia::render('User/Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
