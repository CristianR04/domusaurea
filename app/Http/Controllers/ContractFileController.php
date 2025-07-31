<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\contract_file;

class ContractFileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_propiedad' => 'required|integer|exists:owner_register_properties,id_propiedad',
            'archivo'      => 'required|file|mimes:pdf,doc,docx|max:10240',
            'descripcion'  => 'nullable|string',
        ]);

        $archivo = $request->file('archivo');

        $nombreOriginal = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
        $nombreLimpio   = Str::slug($nombreOriginal);
        $fecha          = now()->format('Ymd_His');
        $extension      = $archivo->getClientOriginalExtension();

        $nombreArchivo = "{$nombreLimpio}_{$fecha}.{$extension}";

        $path = $archivo->storeAs('public/contratos', $nombreArchivo);
        $url  = Storage::url($path); // Accesible desde /storage/...

        $contrato = contract_file::create([
            'id_propiedad' => $request->id_propiedad,
            'nombre'       => $nombreArchivo,
            'descripcion'  => $request->descripcion,
            'ruta_archivo' => $url,
            'tipo_mime'    => $archivo->getClientMimeType(),
        ]);

        return response()->json([
            'mensaje' => 'Contrato guardado correctamente.',
            'data'    => $contrato,
        ], 201);
    }
}
