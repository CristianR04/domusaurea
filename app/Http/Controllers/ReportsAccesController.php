<?php
namespace App\Http\Controllers;

use App\Models\Reports_Acces;
use Illuminate\Support\Facades\Storage;

class OwnerReportAccessController extends Controller
{
    // Listar accesos por propiedad
    public function index($id_propiedad)
    {
        $registros = Reports_Acces::where('id_propiedad', $id_propiedad)
                        ->with('reporte')
                        ->get();

        if ($registros->isEmpty()) {
            return response()->json(['mensaje' => 'No hay reportes para esta propiedad.'], 404);
        }

        return response()->json([
            'mensaje' => 'Reportes encontrados.',
            'data' => $registros
        ]);
    }

    // Descargar un PDF por ID
    public function descargar($id)
    {
        $registro = Reports_Acces::findOrFail($id);
        $ruta = str_replace('/storage/', 'public/', $registro->archivo_pdf);

        if (!Storage::exists($ruta)) {
            return response()->json(['mensaje' => 'Archivo no encontrado.'], 404);
        }

        return response()->download(storage_path('app/' . $ruta));
    }
}
