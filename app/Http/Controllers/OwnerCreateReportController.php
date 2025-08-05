<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Owner_Create_Report;

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

    // Generar PDF
    $pdf = Pdf::loadView('reportes.reporte', ['data' => $validated]);

    $nombreArchivo = 'reporte_' . Str::slug($validated['nombre_propiedad']) . '_' . now()->format('Ymd_His') . '.pdf';
    $ruta = "public/reportes/{$nombreArchivo}";

    // Guardar PDF en disco
    Storage::put($ruta, $pdf->output());

    // Obtener URL pública
    $url = Storage::url("reportes/{$nombreArchivo}");

    // Guardar en base de datos incluyendo la URL
    $reporte = Owner_Create_Report::create(array_merge(
        $validated,
        ['archivo_pdf' => $url]
    ));

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

    if ($request->has('id_user')) {
        $query->where('id_user', $request->id_user);
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
public function descargarPDF($id_propiedad)
{
    // Buscar el último reporte con esa matrícula
    $reporte = Owner_Create_Report::where('id_propiedad', $id_propiedad)
                ->latest()
                ->first();

    if (!$reporte || !isset($reporte->archivo_pdf)) {
        return response()->json(['mensaje' => 'Reporte no encontrado para este ID.'], 404);
    }

    // Convertir URL pública a ruta de storage
    $rutaStorage = str_replace('/storage/', 'public/', $reporte->archivo_pdf);

    if (!Storage::exists($rutaStorage)) {
        return response()->json(['mensaje' => 'El archivo PDF no se encuentra en el servidor.'], 404);
    }

    // Descargar
    return Storage::download($rutaStorage, 'reporte_' . $id_propiedad . '.pdf');
}

}
