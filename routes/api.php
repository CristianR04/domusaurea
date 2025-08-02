<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerRegisterContractController;
use App\Http\Controllers\DocumentPropertyController;
use App\Http\Controllers\OwnerCreateRecordatoryController;
use App\Http\Controllers\OwnerCreateReportController;
use App\Http\Controllers\OwnerPaymentControlController;
use App\Http\Controllers\OwnerRegisterPropertyController;
use App\Http\Controllers\OwnerRegisterTenantController;
use App\Http\Controllers\OwnerReportAccessController;
use App\Http\Controllers\TenantContractAccesController;
use App\Http\Controllers\ContractFileController;
use App\Http\Controllers\TenantCreateRecordatoriesCxPController;
use App\Http\Controllers\TenantRegisterPaymentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registro-user', [UserController::class, 'create']);
//crear un contrato
Route::post('/contratos/generar', [OwnerRegisterContractController::class, 'store']);
//subir archivo de contratos
Route::post('/contratos', [ContractFileController::class, 'store']);
// Ver contratos de una propiedad
Route::get('/contratos/propiedad/{id_propiedad}', [OwnerRegisterContractController::class, 'contratosPorPropiedad']);
// Descargar un contrato PDF
Route::get('/contratos/descargar/{id}', [OwnerRegisterContractController::class, 'descargar']);
//documentos de la propiedad
Route::post('/documentos', [DocumentPropertyController::class, 'documentos']);
// Crear un recordatorio
Route::post('/recordatorios', [OwnerCreateRecordatoryController::class, 'store']);
// Ver recordatorios activos de un inquilino
Route::get('/recordatorios/{id_inquilino}', [OwnerCreateRecordatoryController::class, 'index']);
// Marcar un recordatorio como visto
Route::put('/recordatorios/{id}/visto', [OwnerCreateRecordatoryController::class, 'marcarComoVisto']);
//crear reportes
Route::post('/reportes', [OwnerCreateReportController::class, 'store']);
 // Ver todos los reportes o filtrarlos
Route::get('/reportes', [OwnerCreateReportController::class, 'index']);
// Descargar un PDF por nombre de archivo
Route::get('/reportes/descargar/{nombreArchivo}', [OwnerCreateReportController::class, 'descargarPDF']); 
// Ver pagos por propiedad
Route::get('/pagos/{id_propiedad}', [OwnerPaymentControlController::class, 'index']);
// Descargar soporte de un pago
Route::get('/pagos/descargar/{id_pago}', [OwnerPaymentControlController::class, 'descargar']);
//registrar propiedad
Route::post('/propiedades', [OwnerRegisterPropertyController::class, 'create']);
//asociar un inquilino a propiedad
Route::post('/inquilinos/asociar', [OwnerRegisterTenantController::class, 'store']);
// Ver  reportes por propiedad
Route::get('/reportes-acceso/{id_propiedad}', [OwnerReportAccessController::class, 'index']);
// Descargar un reporte PDF por ID de acceso
Route::get('/reportes-acceso/descargar/{id}', [OwnerReportAccessController::class, 'descarar']);
//acceso a contratos
Route::get('/contratos-inquilino/propiedad/{id}', [TenantContractAccesController::class, 'listarPorPropiedad']);
// Crear recordatorio
Route::post('/cxp/recordatorios', [TenantCreateRecordatoriesCxPController::class, 'store']);
// Listar recordatorios activos del inquilino
Route::get('/cxp/recordatorios/{id_inquilino}', [TenantCreateRecordatoriesCxPController::class, 'index']);
// Marcar un recordatorio como visto
Route::put('/cxp/recordatorios/visto/{id}', [TenantCreateRecordatoriesCxPController::class, 'marcarComoVisto']);
//registrar un pago
Route::post('/pagos-inquilino', [TenantRegisterPaymentController::class, 'store']);

Route::get('/buscar-propiedad/{id_catastral}', [OwnerRegisterPropertyController::class, 'buscarPorIdCatastral']);
