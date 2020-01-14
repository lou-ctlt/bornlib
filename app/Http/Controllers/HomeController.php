<?php

namespace App\Http\Controllers;

use App\Models\MetaUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $meta_user = DB::table('meta_users')->select("car", "electric_terminal", "profile_photo", "electric_terminal_photo")->where("users_id", Auth::user()->id)->get();
        // $meta_users = new MetaUser();
        // $meta_user = $meta_users->where("users_id", Auth::user()->id)->groupBy("items")->get();
        // dd($meta_user);
        return view('home')->with("meta_user", $meta_user);
    }

    public function update(Request $request)
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
            DB::table("meta_users")->where("users_id", Auth::user()->id)->update([ // Update dans mate_users
                "car" => $values["car"],
                "electric_terminal" => $values["electric_terminal"],
                "profile_photo" => $request->file("profile_photo")->getClientOriginalName(),
                "electric_terminal_photo" => $request->file("electric_terminal_photo")->getClientOriginalName()
            ]);
            if($_FILES["profile_photo"]){ // Put de la photo de profile
                $request->file('profile_photo')->storeAs("public/profile_photo", $request->file('profile_photo')->getClientOriginalName());
            }
            if($_FILES["electric_terminal_photo"]){ // Put de la photo de la borne
                $request->file('electric_terminal_photo')->storeAs("public/electric_terminal_photo", $request->file('electric_terminal_photo')->getClientOriginalName());
            }
        };
        $meta_user = DB::table('meta_users')->select("car", "electric_terminal", "profile_photo", "electric_terminal_photo")->where("users_id", Auth::user()->id)->get();
        return view('home')->with("meta_user", $meta_user);
    }
}
