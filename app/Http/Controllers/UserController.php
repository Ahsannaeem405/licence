<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\License;
use App\Models\UserRole;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use League\CommonMark\Block\Element\Document;
use Session;


class UserController extends Controller
{

   public function userAssets(Request $request){
    $id =  $request->route('id');
    $allLicense = License::where("user_id", $id)->get();
    // return $allLicense;
    $userInfo = User::where("id",$id)->first();
    // return $userInfo;
    $return = [
        "allLicense" => $allLicense,
        "userInfo" => $userInfo
    ];
   
    return view("Admin.user_assets", $return);
   }


   public function updateRole(Request $request){
    //    return $request->role;
    //    $logRole = '';
       if($request->role == "csr" || $request->role == "admin"){
            $logRole = "admin";
       }else{
            $logRole = "user";
       }

       User::where("id" , $request->id)->update([
           "user_role" => $request->role,
           "role" => $logRole
       ]);
       session()->flash("success" , "Role updated successfully");
       return back();
   }

    public function listing(){
        $userRole = Auth::user()->role; 
        $roles = UserRole::where("super_admin", "=", "1")->get("role");
        if(Auth::user()->user_role == "super_admin"){
        $users=User::where('user_role', "!=", 'super_admin')->get();
        }

        if(Auth::user()->user_role == "admin"){
            $users=User::where('user_role', "=", 'csr')->orwhere("user_role","=", "client")->get();
        }

        if(Auth::user()->user_role == "csr"){
            $users=User::where('user_role', "=", 'client')->get();
        }
        $return = [
            "users" => $users,
            "roles" => $roles
        ];
            return view('Admin.users',$return);
    }

    public function deleteUser(Request $request){
        User::where("id", $request->id)->delete();
        Session::has("success", "Deleted successfully!");
        return back();
    }

    public function editUser(Request $request){
        $user = User::where("id", $request->id)->first();
        $return = [
            "user" => $user,
            
        ];
        return view('Admin.edituser', $return);

    }

    public function updateUser(Request $request){
        // return $request;
        if(!empty($request->file)){
            $extenssion = $request->file->getClientOriginalExtension();
            $imageName = "img-".rand() . "-" . Carbon::now()->format("Ymd") . "." . $extenssion;
            $path = public_path('profile');
            $request->file->move($path, $imageName);
        }else{
            $image = User::where("id",$request->id)->first();
            $imageName = $image->profile;
        }

        User::where("id", $request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->mobile,
            "billing_address" => $request->address,
            "billing_info" => $request->info,
            "profile_image" => $imageName
        ]);

        Session::flash("success", "Updated successfully!");
        return back();
    }


}
