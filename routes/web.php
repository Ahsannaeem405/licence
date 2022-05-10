<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\SettingController;
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
    Route::get("/settings", function(){
        return view("settings");
    });

    Route::get("/profile", function(){
        return view("Admin.profile");
    });
    Route::get('/edit-user', [AdminController::class, "editUser"]);
    Route::get('/index', function () {
        $allCountUsers = User::all()->count();

        $return = [
            "allUsers" => $allCountUsers,
        
        ];
        // return $allCountUsers;
        return view('Admin.index', $return);
    });
Route::post("site_logo", [SettingController::class, 'siteLogo']);
    Route::get("/update-role", [UserController::class, "updateRole"])->name("updateRole");
    Route::post("/update-user", [UserController::class, "updateUser"])->name("updateUserInfo");
    Route::get("/delete-user", [UserController::class, "deleteUser"])->name("deleteUser");
    Route::get("/users", [UserController::class, "listing"]);
    
    Route::get('/edituser', [UserController::class, "editUser"])->name("editUser");
    
    Route::get('/assets', function () {
        if(Auth::user()->user_role == "super_admin"){
            $license=User::where('user_role', "!=", 'super_admin')->get();
            }
    
            if(Auth::user()->user_role == "admin"){
                $license=User::where('user_role', "=", 'csr')->orwhere("user_role","=", "client")->get();
            }
    
            if(Auth::user()->user_role == "csr"){
                $license=User::where('user_role', "=", 'client')->get();
            }
        // $license = User::where("role","user")->get();
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


Route::get('/userProfile', function(){
    return view("userProfile");
});
Route::post("/update-user", [UserController::class, "updateUserInfo"])->name("userInfo");

Route::post("/sort", [LicenseController::class, 'index'])->name("sortBy");
Route::post("/filter", [LicenseController::class, 'index'])->name("filter");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
