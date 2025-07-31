<?php

namespace App\Http\Controllers;

use App\Models\OwnerRegisterProperty;
use Illuminate\Http\Request;

class OwnerRegisterPropertyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_matricula'      => 'required|integer',
            'id_catastral'          => 'required|integer',
            'direccion_inmueble'    => 'required|string|max:255',
            'area_terreno'          => 'required|string|max:100',
            'uso'                   => 'required|string|max:100',
            'estrato'               => 'required|string|max:10',
            'nombre_propietario'    => 'required|string|max:255',
            'tipo_id'               => 'required|string|max:50',
            'numero_id'             => 'required|integer',
            'estado_civil'          => 'required|string|max:50',
            'direccion_propietario' => 'required|string|max:255',
            'telefono'              => 'required|numeric',
            'correo'                => 'required|email|max:255',
        ]);

        $propiedad = Owner_Register_Property::create($validated);

        return response()->json([
            'mensaje' => 'Propiedad registrada correctamente.',
            'data'    => $propiedad,
        ], 201);
    }
}
