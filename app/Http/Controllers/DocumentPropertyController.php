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
        

        $file = $request->file('archivo');
        $path = $file->store('public/archivos');

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
