<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function update2(Request $request)
    {
        $values = $request->all();
        //dd($request->file('profile_photo'));
        if(!empty($_POST["firstname"]) && isset($_POST["firstname"])) {
            DB::table("users")->where("id", Auth::user()->id)->update([ // Update dans users
                "firstname" => $values["firstname"],
                "lastname" => $values["lastname"],
                "email" => $values["email"],
                "address" => $values["address"],
                "license_plate" => $values["license_plate"],
                "ID_number" => $values["ID_number"]
            ]);
            DB::table("meta_users")->where("users_id", Auth::user()->id)->update([ // Update dans meta_users
                "car" => $values["car"],
                "electric_terminal" => $values["electric_terminal"],
            ]);
            if($_FILES["profile_photo"]){ // Put de la photo de profile
                $request->file('profile_photo')->storeAs("public/profile_photo", $request->file('profile_photo')->getClientOriginalName());
                DB::table("meta_users")->where("users_id", Auth::user()->id)->update([
                    "profile_photo" => $request->file("profile_photo")->getClientOriginalName()
                ]);
            }
            if($_FILES["electric_terminal_photo"]){ // Put de la photo de la borne
                $request->file('electric_terminal_photo')->storeAs("public/electric_terminal_photo", $request->file('electric_terminal_photo')->getClientOriginalName());
                DB::table("meta_users")->where("users_id", Auth::user()->id)->update([
                    "electric_terminal_photo" => $request->file("electric_terminal_photo")->getClientOriginalName()
                ]);
            }
        };
        $meta_user = DB::table('meta_users')->select("car", "electric_terminal", "profile_photo", "electric_terminal_photo")->where("users_id", Auth::user()->id)->get();
        return view('home')->with("meta_user", $meta_user);
    }
}

