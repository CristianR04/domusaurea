<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractFileController extends Controller
{
public function store(Request $request)
{
$request->validate([
'archivo' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB
'descripcion' => 'nullable|string',
]);

$archivo = $request->file('archivo');

$nombreOriginal = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
$nombreLimpio = Str::slug($nombreOriginal);
$fecha = now()->format('Ymd_His');
$extension = $archivo->getClientOriginalExtension();

$nombreArchivo = "{$nombreLimpio}_{$fecha}.{$extension}";

$path = $archivo->storeAs('public/contratos', $nombreArchivo);

$url = Storage::url($path); // Accesible desde /storage/...

$contrato = Contrato::create([
    'nombre' => $nombreArchivo,
    'descripcion' => $request->descripcion,
    'ruta_archivo' => $url,
    'tipo_mime' => $archivo->getClientMimeType(),
]);

return response()->json([
    'mensaje' => 'Contrato guardado correctamente.',
    'data' => $contrato,
], 201);
}
}
