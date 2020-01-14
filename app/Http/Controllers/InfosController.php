<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class InfosController extends Controller
{
    public function index(){
        return view('myaccount.infos');
    }

    public function store(Request $request){
        $user = Auth::user();
        dd($user->id);
        //Vérification des données
        $rules = [
            'license-plate' => 'string',
            'electric_terminal_photo' => 'string',
            'profile_photo' => 'string'
        ];
        
        $validator = Validator::make($data, $rules, [
            'license-plate.license-plate' => 'Votre saisie est incorrecte',
        ]);
        //Renvoie au formulaire si il y a une erreur
        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        
        //Enregistrement de la photo de profil
        $fileinfo = pathinfo($_FILES["profile_photo"]);

        $extension = strtolower($fileinfo["extension"]);

        $extension_autorise = ["jpg", "jpeg", "png"];
            if(in_array($extension, $extension_autorise)){
                Storage::putFileAs('public/profile_photo', new File($data["profiles_photo"]), $request->file('profiles_photo')->getClientOriginalName().'.'.$extension);
            // Si l'extension est OK, j'enregirstre les infos en bdd
                $infos = new Infos($data);
                $infos->car = $data["car"];
                $infos->electric_terminal = $data["electric_terminal"];

            }
    }
}
