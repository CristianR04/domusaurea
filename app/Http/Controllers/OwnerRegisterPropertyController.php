<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Owner_Register_Property;

class OwnerRegisterPropertyController extends Controller
{
    public function create(Request $request)
    {
       Owner_Register_Property::create([
            'numero_matricula'      =>  $request->numero_matricula,
            'id_catastral'          =>  $request->id_catastral,
            'direccion_inmueble'    =>  $request->direccion_inmueble,
            'area_terreno'          =>  $request->area_terreno,
            'uso'                   =>  $request->uso,
            'estrato'               =>  $request->estrato,
            'nombre_propietario'    =>  $request->nombre_propietario,
            'tipo_id'               => $request->tipo_id,
            'numero_id'             => $request->numero_id,
            'estado_civil'          => $request->estado_civil,
            'direccion_propietario' => $request->direccion_propietario,
            'telefono'              => $request->telefono,
            'correo'                => $request->correo,
        

       ]);

        return response()->json([
           "message" => "Registro exitoso"
        ], 201);
    }

    public function buscarPorIdCatastral($id_catastral)
    {
        $propiedad = Owner_Register_Property::where('id_catastral', $id_catastral)->first();

        if ($propiedad) {
            return response()->json([
                "data" => $propiedad,
                "message" => "Consulta exitosa"
            ], 200);
        } else {
            return response()->json([
                "message" => "Propiedad no encontrada"
            ], 404);
        }
    }

}

