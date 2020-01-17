<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Redirect;

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
        $user->delete();
        $users = User::all();
        return view('admin.index')->with('users',$users);
                                
        
    }

    //Méthode pour ajouter un utilisateur
    public function addUser(){
        return view();
    }

    //Méthode pour afficher la fiche user
    public function showUser(Request $request){

        $user = User::find($request->id);
        // dd($user);
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
        //dd($values)-> ok, je passe;
       
        $rules=[
            'firstname'     => 'string|required',
            'lastname'      => 'string|required' ,
            'email'         => 'email|required',
            'address'       => 'string|required',
            'ID_number'     => 'string|required|min:12|max:12' ,
            'license_plate' => 'max:10',
            //'electric_terminal_photo' =>'image|mimes:jpeg,png,jpg,gif|max:1080|nullable' ,
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
            'ID_number.min'         => 'Le numéro de CNI doit comporter 12 caractères ',
            'ID_number.max'         => 'Le numéro de CNI doit comporter 12 caractères',
            //'license_plate.string'  => 'L\'immatriculation ne doit pas comporter de caractères spéciaux',
            //'electric_terminal_photo.image' =>'Ce fichier n\'est pas une image',
            //'electric_terminal_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            //'electric_terminal_photo.max' =>'La taille de l\'image est trop importante',
            //'profile_photo.image' =>'Ce fichier n\'est pas une image',
            //'profile_photo.mimes' =>'L\'extension de l\'image n\'est pas correcte',
            //'profile_photo.max' =>'La taille de l\'image est trop importante',
            
        ]);

        if($validator->fails()){
            dd($validator->fails());

            return Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                            }
        
        
        $user1 = User::where("email", $values['email'])->update([

            "firstname"                     => $values["firstname"],
            "lastname"                      => $values["lastname"],
            "email"                         => $values["email"],
            "ID_number"                     => $values["ID_number"],
            "license_plate"                 => $values["address"], 
            //"electric_terminal_photo"       => $values["electric_terminal_photo"], 
            //"profile_photo"                 => $values["profile_photo"],         
        ]); 
        
        if($_FILES["profile_photo"]["error"] == 0){ // Ajout de la photo de profil seulement si un fichier est proposé
            $request->file('profile_photo')->storeAs("public/profile_photo", $request->file('profile_photo')->getClientOriginalName());
            User::where("email", $values['email'])->update([
                "profile_photo" => $request->file("profile_photo")->getClientOriginalName()
            ]);
        }
        if($_FILES["electric_terminal_photo"]["error"] == 0){ // Put de la photo de la borne seulement si un ficher est proposé
            $request->file('electric_terminal_photo')->storeAs("public/electric_terminal_photo", $request->file('electric_terminal_photo')->getClientOriginalName());
            User::where("email", $values['email'])->update([
                "electric_terminal_photo" => $request->file("electric_terminal_photo")->getClientOriginalName()
            ]);
        }               
                           
        $user = User::all();
            //dd($user);
            return redirect()->route('admin.index')->with('users', $user);    
                
              
            
            
        
        
                
            
            
       
            
          
      }
}

