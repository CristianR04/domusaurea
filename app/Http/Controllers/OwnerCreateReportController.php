<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OwnerCreateReportController extends Controller
{
  public function store(Request $request)
{
    $validated = $request->validate([
        'nombre_propiedad'        => 'required|string|max:255',
        'direccion'               => 'required|string|max:255',
        'matricula_inmobiliaria'  => 'required|string|max:100',
        'tipo_propiedad'          => 'required|string|max:100',
        'uso_inmueble'            => 'required|string|max:100',
        'estado'                  => 'required|string|max:100',
        'id_inquilino'            => 'required|integer',
        'inquilino'               => 'required|string|max:255',
        'arriendo_mensual'        => 'required|integer|min:0',
        'estado_pago'             => 'required|string|max:100',
        'mantenimiento'           => 'nullable|integer|min:0',
        'administracion'          => 'nullable|integer|min:0',
        'impuestos'               => 'nullable|integer|min:0',
        'servicios_publicos'      => 'nullable|integer|min:0',
        'ingreso_mensual'         => 'nullable|integer|min:0',
        'egreso_mensual'          => 'nullable|integer|min:0',
        'contrato'                => 'required|string|max:255',
        'observaciones'           => 'nullable|string',
    ]);

    // 1. Crear el registro en la base de datos
    $reporte = Owner_Create_Report::create($validated);

    // 2. Generar PDF
    $pdf = Pdf::loadView('reportes.reporte', ['data' => $validated]);

    $nombreArchivo = 'reporte_' . Str::slug($validated['nombre_propiedad']) . '_' . now()->format('Ymd_His') . '.pdf';
    $ruta = "public/reportes/{$nombreArchivo}";

    // 3. Guardar PDF en storage/app/public/reportes
    Storage::put($ruta, $pdf->output());

    // 4. Obtener URL pública
    $url = Storage::url("reportes/{$nombreArchivo}");

    return response()->json([
        'mensaje' => 'Reporte creado y PDF generado correctamente.',
        'data'    => $reporte,
        'archivo_pdf' => $url,
    ], 201);

   
}
 //  Ver reportes (filtrados por id_inquilino opcionalmente)
public function index(Request $request)
{
    $query = Owner_Create_Report::query();

    if ($request->has('id_inquilino')) {
        $query->where('id_inquilino', $request->id_inquilino);
    }

    if ($request->has('id_propiedad')) {
        $query->where('matricula_inmobiliaria', $request->id_propiedad);
    }

    $reportes = $query->orderBy('created_at', 'desc')->get();

    return response()->json([
        'mensaje' => 'Reportes encontrados.',
        'data' => $reportes,
    ]);
}

//  Descargar un PDF por nombre de archivo
public function descargarPDF($nombreArchivo)
{
    $path = storage_path("app/public/reportes/{$nombreArchivo}");

    if (!file_exists($path)) {
        return response()->json(['mensaje' => 'Archivo no encontrado.'], 404);
    }

    return response()->download($path);
}

}
