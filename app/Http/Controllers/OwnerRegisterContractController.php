<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerRegisterContractController extends Controller
{
     public function store(Request $request)
    {
        $request->validate([
            'propietario' => 'required|string',
            'inquilino' => 'required|string',
            'fecha' => 'required|date',
            'detalles' => 'required|string',
        ]);

        // Recoger los datos
        $data = $request->only(['propietario', 'inquilino', 'fecha', 'detalles']);

        // Generar PDF
        $pdf = Pdf::loadView('contratos.contrato', ['contrato' => $data]);

        // Generar nombre del archivo
        $nombreArchivo = 'contrato_' . Str::slug($data['inquilino']) . '_' . now()->format('Ymd_His') . '.pdf';

        // Guardar en storage/app/public/contratos
        $rutaAlmacenamiento = "public/contratos/{$nombreArchivo}";
        Storage::put($rutaAlmacenamiento, $pdf->output());

        // Guardar en base de datos
        $contrato = Contrato::create([
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
}
