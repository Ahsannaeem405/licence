<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/edit-user', [AdminController::class, "editUser"]);
    Route::get('/index', function () {
        return view('Admin.index');
    });
    
    Route::get("/update-role", [UserController::class, "updateRole"])->name("updateRole");
    Route::post("/update-user", [UserController::class, "updateUser"])->name("updateUserInfo");
    Route::get("/delete-user", [UserController::class, "deleteUser"])->name("deleteUser");
    Route::get("/users", [UserController::class, "listing"]);
    
    Route::get('/edituser', [UserController::class, "editUser"])->name("editUser");
    
    Route::get('/assets', function () {
        $license = User::where("role","user")->get();
        // dd($license);
        
        return view('Admin.assets', compact('license'));
    });

    Route::get('/user_assets/{id}', [UserController::class, "userAssets"]);



});

Route::post("/license-save", [LicenseController::class, "LicenseSave"])->name("license");
Route::get('license-delete', [LicenseController::class, "delLicense"])->name("license-del");
Route::post('license-update', [LicenseController::class, "updateLicense"])->name("update");

Route::prefix("/user")->middleware(['SessionCheck', 'auth'])->group(function(){
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
