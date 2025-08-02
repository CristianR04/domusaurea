<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\document_property;

class DocumentPropertyController extends Controller
{
    public function documentos(Request $request)
    {
        $request->validate([
            'id_propiedad' => 'required|exists:owner_register_properties,id_propiedad',
            'archivo'      => 'required|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:10240',
            'descripcion'  => 'nullable|string',
        ]);

        $file = $request->file('archivo');
        $path = $request->file('archivo')->store('archivos', 'public');


        $archivo = document_property::create([
            'id_propiedad'     => $request->id_propiedad,
            'nombre_original'  => $file->getClientOriginalName(),
            'ruta'             => Storage::url($path),
            'descripcion'      => $request->descripcion,
            'tipo_mime'        => $file->getClientMimeType(),
        ]);

        return response()->json(['data' => $archivo], 201);
    }
}
