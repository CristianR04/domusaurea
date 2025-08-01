<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Validator;

 class UserController extends Controller
{
    public function
    create(Request $request){
        User::create([
            "name" => $request->nombre,
            "email" => $request->correo,
            "tel" => $request->telefono,
            "password" => Hash::make($request->contrasena),
            "rol" => $request->rol, 
        ]);
        return response()->json([
            "message" => "Registro exitoso"
        ], 201);
    }
}
 