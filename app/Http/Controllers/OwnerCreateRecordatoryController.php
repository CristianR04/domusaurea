<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner_Create_Recordatory;
class OwnerCreateRecordatoryController extends Controller
{
   // Crear recordatorio
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user'          => 'required|exists:inquilinos,id',
            'id_propiedad'          => 'required|exists:owner_register_properties,id_propiedad',
            'concepto'              => 'required|string|max:255',
            'monto'                 => 'nullable|numeric|min:0',
            'fecha_recordatorio'    => 'required|date|after_or_equal:today',
            'repetir_mensualmente'  => 'required|boolean',
            'notas'                 => 'nullable|string',
        ]);

        $reminder = Owner_Create_Recordatory::create($data);

        return response()->json([
            'mensaje' => 'Recordatorio creado correctamente.',
            'data' => $reminder,
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
