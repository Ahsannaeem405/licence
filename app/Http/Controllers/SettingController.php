<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Session;
use Carbon;

class SettingController extends Controller
{
    public function siteLogo(Request $request){
        // return $request->file;

        if(!empty($request->file)){
            $extenssion = $request->file->getClientOriginalExtension();
            $imageName = "img-".rand()  . "a." . $extenssion;
            $path = public_path('site_logo');
            $request->file->move($path, $imageName);
        }else{
            $image = Setting::where("id","1")->first();
            $imageName = $image->site_logo;
        }

        if(Setting::all()->count() > 0){
            Setting::where("id" , "1")->update([
                "site_logo" => $imageName
            ]);
        }else{
            Setting::create([
                "site_logo" => $imageName
            ]);
        }
        Session::flash("success", "Logo saved successfully");
        return back();
    }
}
