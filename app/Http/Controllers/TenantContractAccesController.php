<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TenantContractAccesController extends Controller
{
    public function listarPorPropiedad($propiedad_id)
{
    $contratos = ContractAccess::where('propiedad_id', $propiedad_id)
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
}
