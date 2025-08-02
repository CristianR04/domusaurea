<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner_Register_Tenant;
class OwnerRegisterTenantController extends Controller
{
      // Asociar un inquilino a una propiedad
    public function store(Request $request)
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
}
