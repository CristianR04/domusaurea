<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerPaymentControlController extends Controller
{
    // Listar todos los pagos por propiedad
    public function index($id_propiedad)
    {
        $pagos = OwnerPaymentControl::where('id_propiedad', $id_propiedad)
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
        $pago = OwnerPaymentControl::findOrFail($id_pago);

        if (!$pago->archivo_url) {
            return response()->json(['mensaje' => 'Este pago no tiene un archivo de soporte adjunto.'], 404);
        }

        // Convertimos la URL en una ruta válida para Storage
        $ruta = str_replace('/storage/', 'public/', $pago->archivo_url);

        if (!Storage::exists($ruta)) {
            return response()->json(['mensaje' => 'El archivo no existe en el servidor.'], 404);
        }

        return Storage::download($ruta, $pago->nombre_archivo);
    }
}
