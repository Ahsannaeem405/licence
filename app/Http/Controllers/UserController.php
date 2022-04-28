<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function editUser(Request $request){
        $user = User::where("id", $request->id)->first();
        $return = [
            "user" => $user,
        ];
        return view('Admin.edituser', $return);

    }


}
