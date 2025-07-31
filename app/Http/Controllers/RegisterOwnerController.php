<?php

namespace App\Http\Controllers;

use App\Models\RegisterOwner;

use Illuminate\Http\Request;

class RegisterOwnerController extends Controller
{
    public function create(Request $request) {
        RegisterOwner::create([
        "tipo_usuario" => $request->tipo_usuario,
       "usuario" => $request->usuario,
       "password" => $request->contrasena,
       "email" => $request->correo,
       "tipo_id" => $request->tipo_id,
       "numero_id" => $request->numero_id,
       "fecha_nacimiento" => $request->fecha_nacimiento,
       "name" => $request->nombre
        ]);

        return response()->json([
            "message" => "Registro existoso"
        ], 201);

        
    }

    public function Login(Request $request) {
        $user = User::where("email", $request->correo)->first();

        if (Hash::check($request->Contrasena, $user->password)) {
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                "status"=> "success",
                "token"=> $token,
            ]);
        }
        return response()->json([
            "status"=> "error",
            "message"=> "Error en las credenciales"
        ], 409);
    }
}
