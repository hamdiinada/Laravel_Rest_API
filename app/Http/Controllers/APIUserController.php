<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
      // On récupère tous les utilisateurs
      $users = User::paginate(10);

      // On retourne les informations des utilisateurs en JSON
      return UserResource::collection($users);

    }


    public function store(Request $request)
    {
       // La validation de données
    $this->validate($request, [
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8'
    ]);

    // On crée un nouvel utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    // On retourne les informations du nouvel utilisateur en JSON
    return response()->json($user, 201);
    }

    public function show(User $user)
    {
       // On retourne les informations de l'utilisateur en JSON
       return new UserResource($user);
    }


    public function update(Request $request, User $user)
    {
    // La validation de données
    $this->validate($request, [
        'name' => 'required|max:100',
        'email' => 'required|email',
        'password' => 'required|min:8'
    ]);

    // On modifie les informations de l'utilisateur
    $user->update([
        "name" => $request->name,
        "email" => $request->email,
        "password" => bcrypt($request->password)
    ]);

    // On retourne la réponse JSON
    return response()->json();
    }


    public function destroy(User $user)
    {
            // On supprime l'utilisateur
            $user->delete();

           // On retourne la réponse JSON
            return response()->json();
    }
}
