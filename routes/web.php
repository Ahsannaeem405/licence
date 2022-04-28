<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);

Route::prefix('/admin')->middleware(['SessionCheck', 'auth'])->group(function () {
    Route::get('/index', function () {
        return view('Admin.index');
    });

    Route::get('/users', function () {
        $users=User::where('role','user')->get();
        return view('Admin.users',compact('users'));
    });

    Route::get('/edituser', function () {
        return view('Admin.edituser');
    });

    Route::get('/assets', function () {
        return view('Admin.assets');
    });

    Route::get('/user_assets', function () {
        return view('Admin.user_assets');
    });


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
