<?php

use App\Http\Controllers\LicenseController;
use App\Http\Controllers\UserController;
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


Route::get('/', [LicenseController::class, "index"]);



Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);

Route::prefix('/admin')->middleware(['SessionCheck', 'auth'])->group(function () {
    Route::get('/index', function () {
        return view('Admin.index');
    });

    Route::get('/users', function () {
        $users=User::where('role','user')->get();
        return view('Admin.users',compact('users'));
    });

    Route::get('/edituser', [UserController::class, "editUser"])->name("editUser");
    
    Route::get('/assets', function () {
        return view('Admin.assets');
    });

    Route::get('/user_assets', function () {
        return view('Admin.user_assets');
    });


});

Route::post("/license-save", [LicenseController::class, "LicenseSave"])->name("license");
Route::get('license-delete', [LicenseController::class, "delLicense"])->name("license-del");
Route::post('license-update', [LicenseController::class, "updateLicense"])->name("update");

Route::prefix("/user")->middleware(['SessionCheck', 'auth'])->group(function(){
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
