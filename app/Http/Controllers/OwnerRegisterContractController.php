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
        $pdf = Pdf::loadView('contracts.contracts', ['contracts' => $data]);

        // Generar nombre del archivo
        $nombreArchivo = 'contracts_' . Str::slug($data['inquilino']) . '_' . now()->format('Ymd_His') . '.pdf';

        // Guardar en storage/app/public/contratos
        $rutaAlmacenamiento = "public/contratos/{$nombreArchivo}";
        Storage::put($rutaAlmacenamiento, $pdf->output());

        // Guardar en base de datos
        $contracts = Owner_Register_Contract::create([
        'id_propiedad' => $data['id_propiedad'],
        'propietario' => $data['propietario'],
        'inquilino' => $data['inquilino'],
        'fecha' => $data['fecha'],
        'detalles' => $data['detalles'],
        'archivo_pdf' => Storage::url("contratos/{$nombreArchivo}"),
]);


        return response()->json([
            'mensaje' => 'Contrato generado y guardado exitosamente.',
            'contrato' => $contracts,
        ]);
    }

    // Ver contratos de una propiedad
public function contratosPorPropiedad($id_propiedad)
{
    $contracts = Owner_Register_Contract::where('id_propiedad', $id_propiedad)
                        ->get();

    if ($contracts->isEmpty()) {
        return response()->json(['mensaje' => 'Esta propiedad no tiene contratos registrados.'], 404);
    }

    return response()->json([
        'mensaje' => 'Contratos encontrados.',
        'data' => $contracts
    ]);
}

// 2. Descargar un contrato PDF por ID
public function descargar($id_contrato)
{
    $contracts = contract_file::findOrFail($id_contrato);

    if (!$contracts->archivo_pdf) {
        return response()->json(['mensaje' => 'Este contrato no tiene PDF asociado.'], 404);
    }

    $rutaStorage = str_replace('/storage/', 'public/', $contracts->archivo_pdf);

    if (!Storage::exists($rutaStorage)) {
        return response()->json(['mensaje' => 'El archivo no existe en el servidor.'], 404);
    }

    return Storage::download($rutaStorage, 'Contrato_' . Str::slug($contracts->inquilino) . '.pdf');
}
}
