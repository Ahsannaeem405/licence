<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\License;
use Illuminate\Support\Carbon;
use Session;


class UserController extends Controller
{

   public function userAssets(Request $request){
    $id =  $request->route('id');
    $allLicense = License::where("user_id", $id)->get();
    $userInfo = User::where("id",$id)->first();
    $return = [
        "allLicense" => $allLicense,
        "userInfo" => $userInfo
    ];
   
    return view("Admin.user_assets", $return);
   }

    public function listing(){
        // return "helo";
        $users=User::where('role','user')->get();
            return view('Admin.users',compact('users'));
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
