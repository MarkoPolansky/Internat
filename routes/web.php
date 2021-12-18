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

    Route::post('/workout/odchod',[\App\Http\Controllers\User\WorkoutController::class,'odchod'])->name('workout.odchod');
    Route::post('/workout/prichod',[\App\Http\Controllers\User\WorkoutController::class,'prichod'])->name('workout.prichod');


    Route::post('/activity/vote',[\App\Http\Controllers\User\AvailableActivityController::class,'vote'])->name('activity.vote');


    Route::get('/hodnotenie',[\App\Http\Controllers\User\RattingController::class,'index'])->name('hodnotenie');


});

Route::get('/hello',[\App\Http\Controllers\Admin\UserController::class,'internatnici'])->name('internatnici');

Route::get('/invite/accept/{token}',[\App\Http\Controllers\Admin\InviteController::class,'processing'])->name('invite.processing')->middleware('guest');
Route::post('/invite/accept/{token}',[\App\Http\Controllers\Admin\InviteController::class,'accept'])->name('invite.accept')->middleware('guest');



Route::group(['middleware' => ['auth', 'role:vychovavatel|Super-Admin'], 'as' => 'admin.', 'prefix' => 'admin','namespace' => 'admin'],function (){
    Route::get('/internatnici',[\App\Http\Controllers\Admin\InternatniciController::class,'index'])->name('internatnici');
    Route::get('/internatnici/{userId}/edit',[\App\Http\Controllers\Admin\InternatniciController::class,'show'])->name('internatnici.show');
    Route::put('/internatnici/{user}',[\App\Http\Controllers\Admin\InternatniciController::class,'update'])->name('internatnici.update');
    Route::delete('/internatnici/{user}',[\App\Http\Controllers\Admin\InternatniciController::class,'destroy'])->name('internatnici.destroy');

    Route::get('/invite/create',[\App\Http\Controllers\Admin\InviteController::class,'create'])->name('invite.create');
    Route::post('/invite',[\App\Http\Controllers\Admin\InviteController::class,'invite'])->name('invite');

    Route::delete('/invite/{inviteId}',[\App\Http\Controllers\Admin\InviteController::class,'destroy'])->name('invite.destroy');



    Route::get('/izby',[\App\Http\Controllers\Admin\ApartmentController::class,'index'])->name('izby');
    Route::get('/izby/{apartmentId}',[\App\Http\Controllers\Admin\ApartmentController::class,'show'])->name('izby.show');


    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');



    Route::get('/upratovanie/create',[\App\Http\Controllers\Admin\CleaningController::class,'create'])->name('upratovanie.create');
    Route::post('/upratovanie',[\App\Http\Controllers\Admin\CleaningController::class,'store'])->name('upratovanie.store');
    Route::delete('/upratovanie/delete',[\App\Http\Controllers\Admin\CleaningController::class,'destroy'])->name('upratovanie.destroy');

Route::get('/oznamenie/create', [\App\Http\Controllers\Admin\AnnouncementController::class,'create'])->name('oznamenie.create');
Route::post('/oznamenie', [\App\Http\Controllers\Admin\AnnouncementController::class,'store'])->name('oznamenie.store');
Route::delete('/oznamenie/delete',[\App\Http\Controllers\Admin\AnnouncementController::class,'destroy'])->name('oznamenie.destroy');



    Route::get('/vychadzky',[\App\Http\Controllers\Admin\OutingController::class,'index'])->name('vychadzky');
    Route::post('/vychadzky/prichod',[\App\Http\Controllers\Admin\OutingController::class,'prichod'])->name('vychadzky.prichod');

    Route::post('/dostupne-vychadzky',[\App\Http\Controllers\Admin\AvailableOutingsController::class,'store'])->name('dostupne-vychadzky.store');

    Route::post('/rating-rule',[\App\Http\Controllers\Admin\RatingRuleController::class,'store'])->name('rating-rule.store');
    Route::get('/rating-rule/{ratingRule}/edit',[\App\Http\Controllers\Admin\RatingRuleController::class,'show'])->name('rating-rule.show');

    Route::put('/rating-rule/{ratingRule}',[\App\Http\Controllers\Admin\RatingRuleController::class,'update'])->name('rating-rule.update');
    Route::delete('/rating-rule/{ratingRule}',[\App\Http\Controllers\Admin\RatingRuleController::class,'destroy'])->name('rating-rule.destroy');


    Route::get('/hodnotenie/create',[\App\Http\Controllers\Admin\RattingController::class, 'create'])->name('hodnotenie.create');
    Route::post('/hodnotenie',[\App\Http\Controllers\Admin\RattingController::class, 'update'])->name('hodnotenie.update');


    Route::get('/activity',[\App\Http\Controllers\Admin\ActivityController::class,'index'])->name('activity.index');

    Route::post('/activity',[\App\Http\Controllers\Admin\ActivityController::class,'store'])->name('activity.store');

    Route::get('/activity/{activityId}',[\App\Http\Controllers\Admin\ActivityController::class,'edit'])->name('activity.edit');

    Route::put('/activity/{activity}',[\App\Http\Controllers\Admin\ActivityController::class,'update'])->name('activity.update');
    Route::delete('/activity/{activity}',[\App\Http\Controllers\Admin\ActivityController::class,'destroy'])->name('activity.destroy');
    Route::get('/workout',[\App\Http\Controllers\Admin\WorkoutController::class,'index'])->name('workout');


});


Route::group(['middleware' => ['auth', 'role:Super-Admin'], 'as' => 'admin.', 'prefix' => 'admin','namespace' => 'admin'],function (){
    Route::get('/users',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('users');
    Route::get('/users/{userId}/edit',[\App\Http\Controllers\Admin\UserController::class,'show'])->name('users.show');
    Route::delete('/users/{user}',[\App\Http\Controllers\Admin\UserController::class,'destroy'])->name('users.destroy');



});



//Route::get('/dashboard', function () {
//    return Inertia::render('User/Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
