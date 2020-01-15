<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'ID_number' => $data['ID_number'],
            'car' => $data['car'],
            'electric_terminal' => $data['electric_terminal'],
            'license_plate' => $data['license_plate'],
            'electric_terminal_photo' => $data['electric_terminal_photo'],
            'profile_photo' => $data['profile_photo']
        ]);
    }
    
    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'electric_terminal_photo' => 'image|mimes:jpeg,png,jpg,gif|max:1080',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:1080'
        ]);

        if($request->hasFile('electric_terminal_photo')){
            $image = $request->file('electric_terminal_photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/public');
            $image->move($destinationPath, $name);
            $this->save();
            
            return back()->with('success','Image Upload successfully');
        }else if($request->hasFile('profile_photo')){
            $image = $request->file('profile_photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/public/storage/profile_photo');
            $image->move($destinationPath, $name);
            $this->save();

            return back()->with('success','Image Upload successfully');
        }
    }
}