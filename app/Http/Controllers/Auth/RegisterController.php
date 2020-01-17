<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Ce Controller permet l'inscription et l'enregistrement de nouveaux utilisateurs
    |
    */

    use RegistersUsers;

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
        return Validator::make(
            $data,
            [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' =>  'required|string|email|max:255|unique:users',
                'password' =>  'required|string|min:8|confirmed',
                'address' =>  'required|string|max:255|formatedaddress',
                'ID_number' =>  'required|string|max:12|min:12',
                'license_plate' =>  'max:10',
                'electric_terminal_photo' =>  'image|mimes:jpeg,png,jpg,gif|max:1080',
                'profile_photo' =>  'required|image|mimes:jpeg,png,jpg,gif|max:1080',
                'cgu' =>  'required',
            ],
            [
               'address.formatedaddress' => "Veuillez remplir le champ d\'adresse avec un format ressemblant à celui-ci '1 rue de l'adresse Ville 00000' et une localisation en Gironde seulement."
            ]);

    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $request = request();

        //enregirstrement en local de la photo de profil
        $profilePhoto = $request->file('profile_photo');
        $profilePhotoSaveAsName = time() . "-profile." .
                                  $profilePhoto->getClientOriginalExtension();

        $destinationPathProfile = storage_path('/app/public/profile_photo/');
        $profilePhoto->move($destinationPathProfile, $profilePhotoSaveAsName);

        //enregirstrement en local de la photo de la borne
        if($_FILES['electric_terminal_photo']['error'] == 0){
            $terminalPhoto = $request->file('electric_terminal_photo');
            $terminalPhotoSaveAsName = time() ."-terminal." .
                                  $terminalPhoto->getClientOriginalExtension();

            $destinationPathTerminal = storage_path('/app/public/electric_terminal_photo/');
            $terminalPhoto->move($destinationPathTerminal, $terminalPhotoSaveAsName);
        }else{
            $terminalPhotoSaveAsName = "NULL";
        }

        //contrôle sur les checkbox
        if(!empty($data['car'])){
            $carValue = $data['car'];
        }else{
            $carValue = '0';
        }

        if(!empty($data['electric_terminal'])){
            $terminalValue = $data['electric_terminal'];
        }else{
            $terminalValue = '0';
        }
        // Conversion de l'adresse en coordonée GPS (longitude latitude) START
        $addressToConvert = $data['address'];
        $convertedAddress = str_replace(" ", "+", $addressToConvert);
        $ch = curl_init(); //curl handler init

        curl_setopt($ch,CURLOPT_URL,"https://api-adresse.data.gouv.fr/search/?q=.$convertedAddress.");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// set optional params
        curl_setopt($ch,CURLOPT_HEADER, false);

        $resultAddress=curl_exec($ch);
        $resultAddress=json_decode($resultAddress);// On transforme le JSON en tableau d'objets php


        $longitude = $resultAddress->features["0"]->geometry->coordinates["0"]; // on récupère latitude et longitude
        $latidude = $resultAddress->features["0"]->geometry->coordinates["1"];
        // Conversion de l'adresse en coordonée GPS (longitude latitude) END

        Mail::to($data['email'])->send(new Contact($request->except("_token")));

        return User::create([
            "firstname" => $data['firstname'],
            "lastname" => $data['lastname'],
            "email" => $data['email'],
            "password" => Hash::make($data['password']),
            "address" => $data['address'],
            "ID_number" => $data['ID_number'],
            "car" => $carValue,
            "electric_terminal" => $terminalValue,
            "license_plate" => $data['license_plate'],
            "electric_terminal_photo" => $terminalPhotoSaveAsName,
            "profile_photo" => $profilePhotoSaveAsName,
            "cgu" => $data['cgu'],
            "longitude" => "$longitude",
            "latitude" => "$latidude",
        ]);

    }
}

// Si on met que le num, features est vide
