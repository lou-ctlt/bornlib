<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Après l'inscription, l'utilisateur est redirigé vers la page HOME.
     *
     * @var string
     */ 
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'ID_number' => ['required', 'string', 'max:12'],
            'electric_terminal_photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:1080'],
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1080']
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function store(Request $request)
    {
        $data = $request->all();

        //enregistrement de la photo de profil
        $fileInfoProfile = pathInfo($_FILES["profile_photo"]["name"]);
        $newNameProfile = time(). ".".$request->file("profile_photo")->getClientOriginalExtension();
        Storage::putFileAs("public/profile_photo", new File($data["profile_photo"]), $newNameProfile);

        //enregistrement de la photo de la borne
        $fileInfoTerminal = pathInfo($_FILES["electric_terminal_photo"]["name"]);
        $newNameTerminal = time().".".$request->file("electric_terminal_photo")->getClientOriginalExtension();
        Storage::putFileAs("public/electric_terminal_photo", new File($data["electric_terminal_photo"]), $newNameTerminal);


        $user = new User($data);
        $user->firstname = $data["firstname"];
        $user->lastname = $data["lastname"];
        $user->email = $data["email"];
        $user->password = Hash::make($data["password"]);
        $user->address = $data["address"];
        $user->ID_number = $data["ID_number"];
        $user->car = $data["car"];
        $user->electric_terminal = $data["electric_terminal"];
        $user->license_plate = $data["license_plate"];
        $user->electric_terminal_photo = $newNameTerminal;
        $user->profile_photo = $newNameProfile;

        return view("home")->with("successMessage", "Vous êtes bien inscrit !");
    }
}
