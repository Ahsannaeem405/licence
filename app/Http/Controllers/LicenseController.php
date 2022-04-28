<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\License;
use Session;

class LicenseController extends Controller
{

    public function updateLicense(Request $request){
        // return $request;
        if(!empty($request->file)){
            $extenssion = $request->file->getClientOriginalExtension();
            $imageName = "img-".Auth::user()->id . "-". rand() . "-" . Carbon::now()->format("Ymd") . "." . $extenssion;
            $path = public_path('uploads');
            $request->file->move($path, $imageName);
        }else{
            $image = License::where("id",$request->id)->first();
            $imageName = $image->document;
        }

        License::where("id", $request->id)->update([
            "name" => $request->name,
            "detail" => $request->detail,
            "expiry" => $request->expiry,
            "document" => $imageName
        ]);

        Session::flash("success", "Updated successfully!");
        return back();
    }

    public function delLicense(Request $request){
        // return $request;
        License::where("id",$request->id)->delete();
        Session::flash("success", "License deleted successfully!");
        return back();
    }

    public function index(){
        if(Auth::check()){
            $today = Carbon::today();
$expired =License::whereDate('expiry', '<', $today->format('Y-m-d'))->orderBy("id","desc")
->where("user_id", Auth::user()->id)
->get();

    //  echo $event; exit;

            $license = License::whereDate('expiry', '>', $today->format('Y-m-d'))->orderBy("id","desc")
            ->where("user_id", Auth::user()->id)
            ->get();
            // $total = $license->count();
            $return = [
                "license" => $license,
                "expired" => $expired
            ];
        
            return view('welcome', $return);
        }else{
            return view('auth.login');
        }
    }

    public function LicenseSave(Request $request){
        // return $request->file;
        if(!empty($request->file)){
            $extenssion = $request->file->getClientOriginalExtension();
            $imageName = "img-".Auth::user()->id . "-". rand() . "-" . Carbon::now()->format("Ymd") . "." . $extenssion;
            $path = public_path('uploads');
            $request->file->move($path, $imageName);
        }
        $data = new License;
        $data->name = $request->name;
        $data->detail = $request->detail;
        $data->expiry = $request->expiry;
        $data->user_id = Auth::user()->id;
        $data->document = $imageName;
        $data->active = "yes";
        $data->save();
        Session::flash("success", "License Added Successfuly!");
        return back();

    }
}
