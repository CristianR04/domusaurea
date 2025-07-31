<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantContractAccesController extends Controller
{
    public function listarPorPropiedad($propiedad_id)
{
    $contratos = Tenant_Contract_Acces::where('id_propiedad', $propiedad_id)
        ->with('contrato') // relacion contrato en el modelo
        ->get();

    if ($contratos->isEmpty()) {
        return response()->json(['mensaje' => 'No hay contratos para esta propiedad.'], 404);
    }

    return response()->json([
        'mensaje' => 'Contratos encontrados.',
        'data' => $contratos
    ]);
}

public function descargarContrato($id)
{
    $acceso = TenantContractAccess::with('contrato')->findOrFail($id);

    if (!$acceso->contrato || !$acceso->contrato->archivo_pdf) {
        return response()->json(['mensaje' => 'Contrato no disponible.'], 404);
    }

    $ruta = str_replace('/storage/', 'public/', $acceso->contrato->archivo_pdf);

    if (!Storage::exists($ruta)) {
        return response()->json(['mensaje' => 'El archivo no se encuentra en el servidor.'], 404);
    }

    $nombreArchivo = 'Contrato_' . Str::slug($acceso->contrato->inquilino) . '.pdf';

    return Storage::download($ruta, $nombreArchivo);
}
}
