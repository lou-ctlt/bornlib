<?php
namespace App\Http\Controllers;
use App\Models\MetaUser;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Users;
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
        $users = DB::table("users")->select("*")->get();

        return view("home")->with("users", $users);
    }


}
