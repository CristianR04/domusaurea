<?php

namespace App\Http\Controllers;

use App\Models\RegisterTenant;

use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function create(Request $request) {
        RegisterTenant::create([
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
