<?php

namespace App\Http\Controllers;

use App\Models\MetaUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $meta_user = DB::table('meta_users')->select("car", "electric_terminal")->where("users_id", Auth::user()->id)->get();
        // $meta_users = new MetaUser();
        // $meta_user = $meta_users->where("users_id", Auth::user()->id)->groupBy("items")->get();
        // dd($meta_user);
        return view('home')->with("meta_user", $meta_user);
        //
    }
}
