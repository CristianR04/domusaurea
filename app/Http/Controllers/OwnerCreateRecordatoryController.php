<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner_Create_Recordatory;
class OwnerCreateRecordatoryController extends Controller
{
   // Crear recordatorio
    public function store(Request $request)
    {
       Owner_Create_Recordatory::create([
            'id_user'          =>  $request->id_user,
            'id_propiedad'          => $request->id_propiedad,
            'concepto'              => $request->concepto,
            'monto'                 => $request->monto,
            'fecha_recordatorio'    => $request->fecha_recordatorio,
            'repetir_mensualmente'  => $request->repetir_mensualmente,
            'notas'                 => $request->notas,
        ]);

        return response()->json([
            'mensaje' => 'Recordatorio creado correctamente.',
            
        ], 201);
    }

    // Mostrar recordatorios activos para un inquilino
    public function index($id_user)
    {
        $hoy = now()->toDateString();

        $recordatorios = Owner_Create_Recordatory::where('id_user', $id_user)
            ->where(function ($query) use ($hoy) {
                $query->where('fecha_recordatorio', $hoy)
                      ->orWhere('repetir_mensualmente', true);
            })
            ->orderBy('fecha_recordatorio')
            ->get();

        return response()->json([
            'mensaje' => 'Recordatorios activos encontrados.',
            'data' => $recordatorios
        ]);
    }

    // Marcar como visto
    public function marcarComoVisto($id)
    {
        $recordatorio = Owner_Create_Recordatory::findOrFail($id);
        $recordatorio->visto = true;
        $recordatorio->save();

        return response()->json(['mensaje' => 'Recordatorio marcado como visto.']);
    }
}
