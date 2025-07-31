<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerRegisterTenantController extends Controller
{
      // Asociar un inquilino a una propiedad
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_propiedad' => 'required|exists:owner_register_properties,id_propiedad',
            'id_inquilino' => 'required|integer',
            'numero_id'    => 'required|integer',
            'usuario'      => 'required|string|max:255',
            'correo'       => 'required|email|max:255',
            'telefono'     => 'required|numeric',
        ]);

        $registro = Owner_Register_Tenant::create($validated);

        return response()->json([
            'mensaje' => 'Inquilino asociado correctamente a la propiedad.',
            'data'    => $registro,
        ], 201);
    }
}
