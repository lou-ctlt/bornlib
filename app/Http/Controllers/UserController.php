<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function update(Request $request)
    {
        $values = $request->all();// On récupère toutes la valeurs du formulaire d'update
        $rules= [// On met en place les règles du validator
            'firstname'     => 'string|required',
            'lastname'      => 'string|required' ,
            'email'         => 'email|required',
            'address'       => 'formatedaddress',
            'ID_number'     =>'string|required|min:12|max:12',
            'license_plate' => 'max:10',
            'electric_terminal_photo' =>'image|mimes:jpeg,png,jpg,gif|max:1080' ,
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:1080'
        ];
        $validator = Validator::make($values,$rules, [// On met en place les messages d'erreurs lié au champs correspondant (en fonction des règles établie juste avant)
            'firstname.string'      => 'Le nom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'firstname.required'    => 'Le nom de l\'utilisateur est obligatoire',
            'lastname.string'       => 'Le prénom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'lastname.required'     => 'Le prénom de l\'utilisateur est obligatoire',
            'email.email'           => 'L\'adresse mail n\'est pas correcte',
            'email.required'        => 'L\'adresse mail de l\'utilisateur est obligatoire',
            'address.formatedaddress' => "Veuillez remplir le champ d\'adresse avec un format ressemblant à celui-ci '1 rue de l'adresse Ville 00000' et une localisation en Gironde seulement.",
            'ID_number.string'      => 'Le numéro d\'identité ne doit pas comporter de caractères spéciaux',
            'ID_number.required'    => 'Le numéro d\'identité est obligatoire',
            'ID_number.min'         => 'Le numéro d\'identité doit comporter 12 caractères',
            'ID_number.max'         => 'Le numéro d\'identité doit comporter 12 caractères',
            'license_plate.max'  => 'L\'immatriculation ne doit pas comporter plus de 10 caractères',
            'electric_terminal_photo.image' =>'Ce fichier n\'est pas une image',
            'electric_terminal_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'electric_terminal_photo.max' =>'La taille de l\'image est trop importante',
            'profile_photo.image' =>'Ce fichier n\'est pas une image',
            'profile_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'profile_photo.max' =>'La taille de l\'image est trop importante',
        ]);

        if($validator->fails()){
            return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                            }
        //dd($request->file('profile_photo'));

        // dd($values);
        if($values['electric_terminal'] == 1){

            // Conversion de l'adresse en coordonée GPS (longitude latitude) START
            $addressToConvert = $values['address'];
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

            DB::table("users")->where("id", Auth::user()->id)->update([ // Update dans users
                "firstname" => $values["firstname"],
                "lastname" => $values["lastname"],
                "email" => $values["email"],
                "address" => $values["address"],
                "license_plate" => $values["license_plate"],
                "ID_number" => $values["ID_number"],
                "car" => $values["car"],
                "electric_terminal" => $values["electric_terminal"],
                "longitude" => "$longitude",
                "latitude" => "$latidude"
            ]);
        }
        else {
            DB::table("users")->where("id", Auth::user()->id)->update([ // Update dans users
                "firstname" => $values["firstname"],
                "lastname" => $values["lastname"],
                "email" => $values["email"],
                "address" => $values["address"],
                "license_plate" => $values["license_plate"],
                "ID_number" => $values["ID_number"],
                "car" => $values["car"],
                "electric_terminal" => $values["electric_terminal"],
                "longitude" => "NULL",
                "latitude" => "NULL"
            ]);
        }
        if($_FILES["profile_photo"]["error"] == 0){ // Put de la photo de profile seulement si un ficher est proposé

            $profilePhoto = $request->file('profile_photo');
            $profilePhotoSaveAsName = time() . "-profile." .
                                  $profilePhoto->getClientOriginalExtension();
            $profilePhoto->storeAs("public/profile_photo", $profilePhotoSaveAsName);

            DB::table("users")->where("id", Auth::user()->id)->update([
                "profile_photo" => $profilePhotoSaveAsName
            ]);
        }
        if($_FILES["electric_terminal_photo"]["error"] == 0){ // Put de la photo de la borne seulement si un ficher est proposé

            $terminalPhoto = $request->file('electric_terminal_photo');
            $terminalPhotoSaveAsName = time() ."-terminal." .
                        $terminalPhoto->getClientOriginalExtension();

            $terminalPhoto->storeAs("public/electric_terminal_photo", $terminalPhotoSaveAsName);

            DB::table("users")->where("id", Auth::user()->id)->update([
                "electric_terminal_photo" => $terminalPhotoSaveAsName
            ]);
        }
        return redirect()->route("myaccount")->with("successMessage", "Votre compte a bien été mis a jour.");
    }
}

