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

    //fonction pour afficher les utilisateurs
    public function index(){
    $users = User::all();
    return view('admin.index')->with('users',$users);
    }

    //fonction pour supprimer un utilisateur
    public function deleteUser(Request $request){
        //dd($request->id);
        $user = User::find($request->id);
        $user->delete();
        $users = User::all();
        return view('admin.index')->with('users',$users);
                                
        
    }

    //méthode pour ajouter un utilisateur
    public function addUser(){
        return view();
    }
    //méthode pour afficher la fiche user
    public function showUser(Request $request){

        $user = User::find($request->id);
        //dd($user->id);
        return view('admin.show')->with('user', $user);
    }

    //méthode pour afficher le formulaire de modification
    public function editUser(Request $request){

        $user = User::find($request->id);
       
        return view('admin.update')->with('user', $user);
        
      }
      //methode pour valider l'enregistrement
      
      public function updateUser(Request $request){
        $values = $request->all();

        // dd($values);
        $rules=[
            'firstname'     => 'string|required',
            'lastname'      => 'string|required' ,
            'email'         => 'email|required',
            'address'       => 'string|required',
            'ID_number'     =>'integer|required' ,
            'license_plate' => 'string',
            'electric_terminal_photo' =>'image|mimes:jpeg,png,jpg,gif|max:1080' ,
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
            'license_plate.string'  => 'L\'immatriculation ne doit pas comporter de caractères spéciaux',
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
    
                            
        
            $user1 = User::where("email", $values['email'])->update([
                "firstname" => $values["firstname"],
                "lastname" => $values["lastname"],
                "email" => $values["email"],
                "address" => $values["address"],
                
              
            ]);
            $user = User::all();
            //dd($user);
            return view('admin.index')->with('users', $user);
        
        
                
            
            
       
            
          
      }
}

