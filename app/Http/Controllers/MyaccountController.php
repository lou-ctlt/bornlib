<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyaccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $meta_user = DB::table('meta_users')->select("car", "electric_terminal", "profile_photo", "electric_terminal_photo")->where("users_id", Auth::user()->id)->get();
        // $meta_users = new MetaUser();
        // $meta_user = $meta_users->where("users_id", Auth::user()->id)->groupBy("items")->get();
        // dd($meta_user);
        return view('myaccount');
    }
}
