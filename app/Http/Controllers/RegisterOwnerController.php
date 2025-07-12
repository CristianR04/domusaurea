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
       "contrasena" => $request->contrasena,
       "correo" => $request->correo,
       "tipo_id" => $request->tipo_id,
       "numero_id" => $request->numero_id,
       "fecha_nacimiento" => $request->fecha_nacimiento
        ]);

        return response()->json([
            "message" => "Registro existoso"
        ], 201);

        
    }
}
