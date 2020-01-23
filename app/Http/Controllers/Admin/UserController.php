<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Validator;
use Redirect;
use Image;
use Mail;
use App\Mail\Admin;
use App\Mail\Admindelete;
use App\Mail\Adminupdate;


use App\Models\User;

class UserController extends Controller
{

    //Méthode pour afficher les utilisateurs
    public function index(){
    $users = User::all();
    return view('admin.index')->with('users',$users);
    }

    //Méthode pour supprimer un utilisateur
    public function deleteUser(Request $request){
        //dd($request->id);
        $user = User::find($request->id);
        //dd($user);
        //Envoi du mail
        $title = " SUPPRESSION DE VOTRE COMPTE BORNLIB\'";
        $content = "";
        Mail::to($user->email)->send(new Admindelete ($title, $content));
        $user->delete();
        $users = User::all();


        return view('admin.index')->with('users',$users);


    }

    //Méthode pour afficher le formulaire d'ajout utilisateur
    public function addUser(){
        return view('admin.store');
    }

    //Méthode pour ajouter un utilisateur
    public function storeUser(Request $request){

        $values = $request->all();
        //dd($request);


        $rules=[

            'role'                      => 'string|required',
            'firstname'                 => 'string|required|max:255',
            'lastname'                  => 'string|required|max:255' ,
            'email'                     => 'email|required|max:255|unique:users',
            'password'                  => 'required|string|min:8',
            'address'                   => 'string|required|max:255|formatedaddress',
            'ID_number'                 => 'string|required|min:12|max:12' ,
            'license_plate'             => 'max:10|nullable',
            'electric_terminal_photo'   => 'image|mimes:jpeg,png,jpg,gif|max:1080' ,
            'profile_photo'             => 'image|mimes:jpeg,png,jpg,gif|max:1080',

        ];

        $validator = Validator::make($values,$rules, [

            'role.required'         =>'Définir un rôle utilisateur est obigatoire',
            'firstname.string'      => 'Le nom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'firstname.required'    => 'Le nom de l\'utilisateur est obligatoire',
            'lastname.string'       => 'Le prénom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'lastname.required'     => 'Le prénom de l\'utilisateur est obligatoire',
            'email.email'           => 'L\'adresse mail n\'est pas correcte',
            'email.required'        => 'L\'adresse mail de l\'utilisateur est obligatoire',
            'password.required'     => 'Le mot de passe est obligatoire',
            'password.string'       => 'Le mot de passe ne doit pas comporter de caratères spéciaux',
            'password.min'          => 'Le nom de passe doit comporter 8 caractères minimun',
            'address.string'        => 'L\'adresse de l\'utilisateur ne doit pas comporter de caractères spéciaux ',
            'address.required'      => 'L\'adresse de l\'utilisateur est obligatoire',
            'address.formatedaddress' => "Veuillez remplir le champ d\'adresse avec un format ressemblant à celui-ci '1 rue de l'adresse Ville 00000' et une localisation en Gironde seulement.",
            'ID_number.string'      => 'Le numéro de CNI ne doit pas comporter de caractères spéciaux ',
            'ID_number.required'    => 'Le numéro de CNI est obligatoire',
            'ID_number.min'         => 'Le numéro de CNI doit comporter 12 caractères, votre saisie est trop courte ',
            'ID_number.max'         => 'Le numéro de CNI doit comporter 12 caractères, votre saisie est trop longue',
            'license_plate.max'     => 'L\'immatriculation doit comporter 10 caractères',
            'electric_terminal_photo.image' =>'Ce fichier n\'est pas une image',
            'electric_terminal_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'electric_terminal_photo.max' =>'La taille de l\'image est trop importante',
            'profile_photo.image' =>'Ce fichier n\'est pas une image',
            'profile_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'profile_photo.max' =>'La taille de l\'image est trop importante',

        ]);
        //dd($validator->fails());
        if($validator->fails()){
            //dd($validator);


            return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                            }

        //Contrôle sur les checkbox
        if(!empty($values['car'])){
            $carValue = $values['car'];

        }else{
            $carValue = '0';
        }

        if(!empty($values['electric_terminal'])){
            $terminalValue = $values['electric_terminal'];
        }else{
            $terminalValue = '0';
        }

        if($carValue === '1'){
            $licenseValue = $values['license_plate'];

        }else{
            $licenseValue = 'NULL';
        }
        //dd($terminalValue);

        //Enregistrement en local de la photo de profil
        $profilePhoto = $request->file('profile_photo');
        $profilePhotoSaveAsName = time() . "-profile." .
                                  $profilePhoto->getClientOriginalExtension();


        $destinationPathProfile = storage_path('/app/public/profile_photo/');
        $profilePhoto->move($destinationPathProfile, $profilePhotoSaveAsName);


        //Enregistrement en local de la photo de la borne si une image est proposée
        if($_FILES['electric_terminal_photo']['error'] == 0){
            $terminalPhoto = $request->file('electric_terminal_photo');
            $terminalPhotoSaveAsName = time() ."-terminal." .
                                  $terminalPhoto->getClientOriginalExtension();

            $destinationPathTerminal = storage_path('/app/public/electric_terminal_photo/');
            $terminalPhoto->move($destinationPathTerminal, $terminalPhotoSaveAsName);
        }else{
            $terminalPhotoSaveAsName = "NULL";

        }


        //dd($values);
        //Conversion de l'adresse en coordonée GPS (longitude latitude) START

        $addressToConvert = $values['address'];
        $convertedAddress = str_replace(" ", "+", $addressToConvert);
        $ch = curl_init(); //curl handler init

        curl_setopt($ch,CURLOPT_URL,"https://api-adresse.data.gouv.fr/search/?q=.$convertedAddress.");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// set optional params
        curl_setopt($ch,CURLOPT_HEADER, false);

        $resultAddress=curl_exec($ch);
        $resultAddress=json_decode($resultAddress);// On transforme le JSON en tableau d'objets php


        $longitude = $resultAddress->features["0"]->geometry->coordinates["0"]; // on récupère latitude et longitude
        $latitude = $resultAddress->features["0"]->geometry->coordinates["1"];


        //dd($request);
        //dd($values);

        //Création d'une nouvelle entrée
        $user = new User();


        //Remplissage des colonnes de la base de données
        $user->role                     = $values['role'];
        $user->firstname    	        = $values['firstname'];
        $user->lastname    	            = $values['lastname'];
        $user->email  	 	            = $values['email'];
        $user->password  	 	        = Hash::make($values['password']);
        $user->address  	 	        = $values['address'];
        $user->ID_number                = $values['ID_number'];
        $user->car                      = $carValue;
        $user->electric_terminal        = $terminalValue;
        $user->license_plate	        = $licenseValue;
        $user->electric_terminal_photo  = $terminalPhotoSaveAsName;
        $user->profile_photo	        = $profilePhotoSaveAsName;
        $user->longitude	            = $longitude;
        $user->latitude	                = $latitude;
        //dd($user->save());

       //Sauvegarde dans la table Users

        $user->save();


        $user->email_verified_at = $user->created_at;
        $user->save();

        //Envoi du mail
        $title = " INSCRIPTION BORNLIB'";
        $content = "";

        Mail::to($values['email'])->send(new Admin ($title, $content));

                return redirect()->route('Admin')
                                    ->with('successMessage','L\'utilisateur est enregistré dans la Base de données');
    }

    //Méthode pour afficher la fiche utilisateur
    public function showUser(Request $request){

        $user = User::find($request->id);
        //CONDITION POUR AFFICHER OUI OU NON A LA PLACE DES VALEURS
        if(!$user->car == 0){
            $user->car = 'OUI';
        }else{
            $user->car = 'NON';
        }

        //CONDITION POUR AFFICHER OUI OU NON A LA PLACE DES VALEURS
        if(!$user->electric_terminal == 0){
            $user->electric_terminal = 'OUI';
        }else{
            $user->electric_terminal = 'NON';
        }

        //CONDITION SI LICENSE_PLATE n'est pas rempli affiche NULL
        if( empty($user->license_plate) ){
            $user->license_plate = 'NULL';
        }

        //dd($user);
        return view('admin.show')->with('user', $user);
    }

    //Méthode pour afficher le formulaire de modification
    public function editUser(Request $request){

        $user = User::find($request->id);

        return view('admin.update')->with('user', $user);


      }

    //Méthode pour valider l'enregistrement des modifications
    public function updateUser(Request $request){

        $values = $request->all();
        //dd($values);

        $rules=[
            'firstname'     => 'string|required',
            'lastname'      => 'string|required' ,
            'email'         => 'email|required',
            'address'       => 'string|required',
            'ID_number'     => 'string|required|min:12|max:12' ,
            'license_plate' => 'max:10',
            'electric_terminal_photo' =>'image|mimes:jpeg,png,jpg,gif|max:1080|nullable',
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:1080'
        ];

        $validator = Validator::make($values,$rules, [

            'firstname.string'      => 'Le nom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'firstname.required'    => 'Le nom de l\'utilisateur est obligatoire',
            'lastname.string'       => 'Le prénom de l\'utilisateur ne doit pas comporter de caractères spéciaux',
            'lastname.required'     => 'Le prénom de l\'utilisateur est obligatoire',
            'email.email'           => 'L\'adresse mail n\'est pas correcte',
            'email.required'        => 'L\'adresse mail de l\'utilisateur est obligatoire',
            'address.string'        => 'L\'adresse de l\'utlisateur ne doit pas comporter de caractères spéciaux ',
            'address.required'      => 'L\'adresse de l\'utilisateur est obligatoire',
            'ID_number.string'      => 'Le numéro de CNI ne doit pas comporter de caractères spéciaux ',
            'ID_number.required'    => 'Le numéro de CNI est obligatoire',
            'ID_number.min'         => 'Le numéro de CNI doit comporter 12 caractères, votre saisie est trop courte ',
            'ID_number.max'         => 'Le numéro de CNI doit comporter 12 caractères, votre saisie est trop longue',
            'license_plate.string'  => 'L\'immatriculation ne doit pas comporter de caractères spéciaux',
            'electric_terminal_photo.image' =>'Ce fichier n\'est pas une image',
            'electric_terminal_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'electric_terminal_photo.max' =>'La taille de l\'image est trop importante',
            'profile_photo.image' =>'Ce fichier n\'est pas une image',
            'profile_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            'profile_photo.max' =>'La taille de l\'image est trop importante',

        ]);

        if($validator->fails()){
            //dd($validator->fails());

            return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                            }

        //Contrôle sur les checkbox
        if(!empty($values['car'])){
            $carValue = $values['car'];
        }else{
            $carValue = '0';
        }
        //dd($carValue);
        if(!empty($values['electric_terminal'])){
            $terminalValue = $values['electric_terminal'];
        }else{
            $terminalValue = '0';
        }
        //dd($terminalValue);
        //dd($values);
        //Donner une valeur NULL à LicenseValue si carValue est différent de 0
        if(!$carValue == 0){
            $licenseValue = $values['license_plate'];
        }else{
            $licenseValue = 'NULL';
        }
        //dd($carValue);
        //dd($licenseValue);


        //Convertion de l'adresse en coordonnées GPS
        $addressToConvert = $values['address'];
        $convertedAddress = str_replace(" ", "+", $addressToConvert);
        $ch = curl_init(); //curl handler init

        curl_setopt($ch,CURLOPT_URL,"https://api-adresse.data.gouv.fr/search/?q=.$convertedAddress.");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// set optional params
        curl_setopt($ch,CURLOPT_HEADER, false);

        $resultAddress=curl_exec($ch);
        $resultAddress=json_decode($resultAddress);// On transforme le JSON en tableau d'objets php


        $longitude = $resultAddress->features["0"]->geometry->coordinates["0"]; // on récupère latitude et longitude
        $latitude = $resultAddress->features["0"]->geometry->coordinates["1"];

        $user1 = User::where("email", $values['email'])->update([


            "firstname"    	           => $values['firstname'],
            "lastname"    	           => $values['lastname'],
            "email"  	 	           => $values['email'],
            "address"  	 	           => $values['address'],
            "ID_number"                => $values['ID_number'],
            "car"                      => $carValue,
            "electric_terminal"        => $terminalValue,
            "car"                      => $carValue,
            "license_plate"	           => $licenseValue,
            "longitude"	               => $longitude,
            "latitude"	               => $latitude

        ]);




        //dd($_FILES);
        //Enregistrement en local de la photo de profil
        if($_FILES["profile_photo"]["error"] == 0){
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoSaveAsName = time() . "-profile." .
                                  $profilePhoto->getClientOriginalExtension();

            $profilePhoto->storeAs("/app/public/profile_photo", $profilePhotoSaveAsName);
            User::where("email", $values['email'])->update([
                "profile_photo" => $profilePhotoSaveAsName
            ]);
        }

        //dd($profilePhotoSaveAsName);

        //dd($_FILES);
        //Enregistrement en local de la photo de la borne si une image est proposée
        if($_FILES["electric_terminal_photo"]["error"] == 0 && !($_FILES["electric_terminal_photo"] == '0')){
            $terminalPhoto = $request->file('electric_terminal_photo');
            $terminalPhotoSaveAsName = time() ."-terminal." .
                                  $terminalPhoto->getClientOriginalExtension();

            $terminalPhoto->storeAs("/app/public/electric_terminal_photo", $terminalPhotoSaveAsName);
            User::where("email", $values['email'])->update([
                "electric_terminal_photo" => $terminalPhotoSaveAsName
            ]);
        }


        //dd($terminalPhotoSaveAsName);
        //dd($values);
        //Envoi du mail
        $title = " MODIFICATION DE VOTRE COMPTE BORNLIB'";
        $content = "SURPRISE";
        Mail::to($values['email'])->send(new Adminupdate ($title,$content));
        $user = User::all();
        //dd($user);

            return redirect()->route('Admin')
                                ->with('successMessage','L\'utilisateur à bien été modifié')
                                ->with('users', $user);
        }
    }
