<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner_Register_Tenant;
class OwnerRegisterTenantController extends Controller
{
      // Asociar un inquilino a una propiedad
    public function create(Request $request)
    {
        Owner_Register_Tenant::create([
            'id_propiedad' => $request->id_propiedad,
            'id_user' => $request->id_user,
            'numero_id'    => $request->numero_id,  
            'usuario'      => $request->usuario,
            'correo'       => $request->correo,
            'telefono'     => $request->telefono,
        ]);

       

        return response()->json([
            'mensaje' => 'Inquilino asociado correctamente a la propiedad.',
            
        ], 201);
    }
    public function buscarPorIdUser($id_user)
    {
        $inquilino = Owner_Register_Tenant::where('id_user', $id_user)->first();

        if ($inquilino) {
            return response()->json([
                "data" => $inquilino,
                "message" => "Consulta exitosa"
            ], 200);
        } else {
            return response()->json([
                "message" => "Inquilino no encontrado"
            ], 404);
        }
    }



}
