<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\License;
use Session;
use DateTime;

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
            $aaj =  $today->format("Y-m-d");
$expired =License::whereDate('expiry', '<', $today->format('Y-m-d'))->orderBy("id","desc")
->where("user_id", Auth::user()->id)
->get();

    //  echo $event; exit;

            $license = License::whereDate('expiry', '>', $today->format('Y-m-d'))->orderBy("id","desc")
            ->where("user_id", Auth::user()->id)
            ->get();

            // return $license;
            $emptyArray = [];

            foreach($license as $li){
               $exp =  $li->expiry;
            //    echo $exp;
            $expDate = new DateTime($exp);
            $aaaj = new DateTime($aaj);
            $interval = $expDate->diff($aaaj);
            $remaining_days = $interval->format('%a');
            // echo $remaining_days; echo " --- ".$aaj." --- ".$exp." ---- ";
            if($remaining_days<30){
                $emptyArray[] = $li;
            }
            }
            // dd($emptyArray);
            // print_r($license); exit;
            $return = [
                "license" => $license,
                "expired" => $expired,
                "soon" => $emptyArray
            ];

            return view('welcome', $return);
        }else{
            return view('auth.login');
        }
    }

    public function LicenseSave(Request $request){
        // dd($request);

        $imageN=[];
        if($request->hasfile('file'))
        {

           foreach($request->file('file') as $file)
           {
            //    $name=$file->getClientOriginalName();
            //    $file->move(public_path().'/files/', $name);
            //    $data[] = $name;

               $extenssion = $file->getClientOriginalExtension();
            $name = "img-".Auth::user()->id . "-". rand() . "-" . Carbon::now()->format("Ymd") . "." . $extenssion;
            $path = public_path('uploadFile');
            $file->move($path, $name);
            $imageN[] = $name;
           }
        }
        // print_r($imageName); exit;
        $imageName = json_encode($imageN);

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
