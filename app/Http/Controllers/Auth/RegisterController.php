<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' =>  'required|string|email|max:255|unique:users',
            'password' =>  'required|string|min:8|confirmed' ,
            'address' =>  'required|string|max:255' ,
            'ID_number' =>  'max:12|min:12',
            'license_plate' =>  'string|max:9|min:9',
            'electric_terminal_photo' =>  'image|mimes:jpeg,png,jpg,gif|max:1080',
            'profile_photo' =>  'required|image|mimes:jpeg,png,jpg,gif|max:1080',
            'cgu' =>  'required',
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
        $profile_photo_url = $destinationPathProfile . $profilePhotoSaveAsName;
        $success = $profilePhoto->move($destinationPathProfile, $profilePhotoSaveAsName);

        //enregirstrement en local de la photo de la borne
        if(!empty($request->file('eletric_terminal_photo'))){
            $terminalPhoto = $request->file('electric_terminal_photo');
        $terminalPhotoSaveAsName = time() ."-terminal." .
                                  $terminalPhoto->getClientOriginalExtension();

        $destinationPathTerminal = storage_path('/app/public/electric_terminal_photo/');
        $terminal_photo_url = $destinationPathTerminal . $terminalPhotoSaveAsName;
        $success = $terminalPhoto->move($destinationPathTerminal, $terminalPhotoSaveAsName);
        }else{
            $terminal_photo_url = "NULL";
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
        "electric_terminal_photo" => $terminal_photo_url,
        "profile_photo" => $profile_photo_url,
        "cgu" => $data['cgu'],
        "longitude" => "NULL",
        "latitude" => "NULL",
        ]);
    }
}
