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
        $users =User::select("*")->get();

        return view("home")->with("users", $users);
    }

    public function move(Request $request)
    {
        $values = $request->all();


        $section = file_get_contents('https://api-adresse.data.gouv.fr/search/?q='.$values["adresse"]);
        $s1 = json_decode($section);

        $test = $s1->features["0"]->geometry->coordinates;
        $encode = json_encode($test);

        return $encode;
    }

    public function list()
    {
        $tableau_coordonnes =[];
        $users1 =User::select("*")->get();
        foreach ($users1 as $user1) {
            $v1 = $user1->longitude;
            $v2 = $user1->latitude;
            if($user1->latitude != "NULL"){
                $tableau_coordonnes += [$v1 => $v2]; // stockage des coordonnées au format longitude/latitude
            }
        }
        //dd($tableau_coordonnes);
        $users = json_encode($tableau_coordonnes);

        return $users;
    }
}
