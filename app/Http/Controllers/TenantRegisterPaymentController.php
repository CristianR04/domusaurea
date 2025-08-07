<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tenant_Register_Payment;
use App\Models\Owner_Register_Tenant;


class TenantRegisterPaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_propiedad'   => 'required|exists:Owner_Register_Tenants,id_propiedad',
            'servicio'       => 'nullable|string|max:100',
            'concepto'       => 'nullable|string|max:255',
            'monto'          => 'required|numeric|min:0.01',
            'fecha_pago'     => 'required|date',
            'observaciones'  => 'nullable|string',
            'archivo'        => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $archivoUrl = null;
        $tipoMime   = null;
        $nombreArchivo = null;

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');

            $nombreOriginal = pathinfo($archivo->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $archivo->getClientOriginalExtension();
            $nombreLimpio = Str::slug($nombreOriginal);
            $fecha = now()->format('Ymd_His');
            $nombreFinal = "{$nombreLimpio}_{$fecha}.{$extension}";

            $ruta = $archivo->storeAs('public/soportes-pagos', $nombreFinal);

            $archivoUrl     = Storage::url($ruta);
            $tipoMime       = $archivo->getClientMimeType();
            $nombreArchivo  = $archivo->getClientOriginalName();
        }

        $pago = Tenant_Register_Payment::create([
            'id_propiedad'   => $request->id_propiedad,
            'servicio'       => $request->servicio,
            'concepto'       => $request->concepto,
            'monto'          => $request->monto,
            'fecha_pago'     => $request->fecha_pago,
            'observaciones'  => $request->observaciones,
            'archivo_url'    => $archivoUrl,
            'nombre_archivo' => $nombreArchivo,
            'tipo_mime'      => $tipoMime,
        ]);

        return response()->json([
            'mensaje' => 'Pago guardado correctamente.',
            'data'    => $pago,
        ], 201);
    }
    public function getPropiedades()
    {
    // Solo devuelve el campo id_propiedad
    return response()->json(
        Owner_Register_Tenant::select('id_propiedad')->get()
    );
    }
}
