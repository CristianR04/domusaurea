<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\document_property;
use Illuminate\Support\Facades\Storage;


class DocumentPropertyController extends Controller
{
    public function documentos(Request $request){
    $request->validate([
        'archivo' => 'required|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:10240', 
        'descripcion' => 'nullable|string'
    ]);

    $file = $request->file('archivo');
    $path = $file->store('public/archivos'); 

    $archivo = Archivo::create([
        'nombre_original' => $file->getClientOriginalName(),
        'ruta' => Storage::url($path), 
        'descripcion' => $request->descripcion,
        'tipo_mime' => $file->getClientMimeType()
    ]);

    return response()->json(['data' => $archivo], 201);
}
}

