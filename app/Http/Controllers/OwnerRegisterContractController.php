<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Owner_Register_Contract;
use App\Models\contract_file;

class OwnerRegisterContractController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'id_propiedad' => 'required|exists:owner_register_properties,id_propiedad',
            'propietario' => 'required|string',
            'inquilino' => 'required|string',
            'fecha' => 'required|date',
            'detalles' => 'required|string',
        ]);

    $data = $request->only(['id_propiedad', 'propietario', 'inquilino', 'fecha', 'detalles']);  
        // Generar PDF
        $pdf = Pdf::loadView('contratos.contrato', ['contrato' => $data]);

        // Generar nombre del archivo
        $nombreArchivo = 'contrato_' . Str::slug($data['inquilino']) . '_' . now()->format('Ymd_His') . '.pdf';

        // Guardar en storage/app/public/contratos
        $rutaAlmacenamiento = "public/contratos/{$nombreArchivo}";
        Storage::put($rutaAlmacenamiento, $pdf->output());

        // Guardar en base de datos
        $contrato = Owner_Register_Contract::create([
        'id_propiedad' => $data['id_propiedad'],
        'propietario' => $data['propietario'],
        'inquilino' => $data['inquilino'],
        'fecha' => $data['fecha'],
        'detalles' => $data['detalles'],
        'archivo_pdf' => Storage::url("contratos/{$nombreArchivo}"),
]);


        return response()->json([
            'mensaje' => 'Contrato generado y guardado exitosamente.',
            'contrato' => $contrato,
        ]);
    }

    // Ver contratos de una propiedad
public function contratosPorPropiedad($id_propiedad)
{
    $contratos = contract_file::where('id_propiedad', $id_propiedad)
                        ->orderBy('fecha', 'desc')
                        ->get();

    if ($contratos->isEmpty()) {
        return response()->json(['mensaje' => 'Esta propiedad no tiene contratos registrados.'], 404);
    }

    return response()->json([
        'mensaje' => 'Contratos encontrados.',
        'data' => $contratos
    ]);
}

// 2. Descargar un contrato PDF por ID
public function descargar($id)
{
    $contrato = contract_file::findOrFail($id);

    if (!$contrato->archivo_pdf) {
        return response()->json(['mensaje' => 'Este contrato no tiene PDF asociado.'], 404);
    }

    $rutaStorage = str_replace('/storage/', 'public/', $contrato->archivo_pdf);

    if (!Storage::exists($rutaStorage)) {
        return response()->json(['mensaje' => 'El archivo no existe en el servidor.'], 404);
    }

    return Storage::download($rutaStorage, 'Contrato_' . Str::slug($contrato->inquilino) . '.pdf');
}
}
