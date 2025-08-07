<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant_Register_Payment;

class OwnerPaymentControlController extends Controller
{
    // Listar todos los pagos por propiedad
    public function index($id_propiedad)
    {
        $pagos = Tenant_Register_Payment::where('id_propiedad', $id_propiedad)
                    ->orderByDesc('fecha_pago')
                    ->get();

        if ($pagos->isEmpty()) {
            return response()->json(['mensaje' => 'No hay pagos registrados para esta propiedad.'], 404);
        }

        return response()->json([
            'mensaje' => 'Pagos encontrados.',
            'data'    => $pagos
        ]);
    }

    // Descargar archivo de soporte de pago
    public function descargar($id_pago)
{
    $pagos = Tenant_Register_Payment::findOrFail($id_pago);

    if (!$pagos->archivo_url) {
        return response()->json(['mensaje' => 'Este pago no tiene un archivo de soporte adjunto.'], 404);
    }

    $ruta = str_replace('/storage/', 'public/', $pagos->archivo_url);

    if (!Storage::exists($ruta)) {
        return response()->json(['mensaje' => 'El archivo no existe en el servidor.'], 404);
    }

    return Storage::download($ruta, $pagos->nombre_archivo);
}

}
