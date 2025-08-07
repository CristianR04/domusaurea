<?php

namespace App\Http\Controllers;

use App\Models\Tenant_Create_Recordatories_CxP;
use Illuminate\Http\Request;

class TenantCreateRecordatoriesCxPController extends Controller
{
    // Crear recordatorio
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user'          => 'required|exists:Owner_Register_Tenants,id_user',
            'id_propiedad'          => 'required|exists:owner_register_properties,id_propiedad',
            'concepto'              => 'required|string|max:255',
            'monto'                 => 'nullable|numeric|min:0',
            'fecha_recordatorio'    => 'required|date|after_or_equal:today',
            'repetir_mensualmente'  => 'required|boolean',
            'notas'                 => 'nullable|string',
        ]);

        $reminder = Tenant_Create_Recordatories_CxP::create($data);

        return response()->json([
            'mensaje' => 'Recordatorio creado correctamente.',
            'data' => $reminder,
        ], 201);
    }

    // Mostrar recordatorios activos para un inquilino
    public function index($id_inquilino)
    {
        $hoy = now()->toDateString();

        $recordatorios = Tenant_Create_Recordatories_CxP::where('id_inquilino', $id_inquilino)
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
        $recordatorio = Tenant_Create_Recordatories_CxP::findOrFail($id);
        $recordatorio->visto = true;
        $recordatorio->save();

        return response()->json(['mensaje' => 'Recordatorio marcado como visto.']);
    }
}
