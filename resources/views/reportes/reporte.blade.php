<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Propiedad</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 10px; }
        p { margin: 2px 0; }
    </style>
</head>
<body>
    <h2>Reporte de Propiedad</h2>

    <p><strong>Propiedad:</strong> {{ $data['nombre_propiedad'] }}</p>
    <p><strong>Dirección:</strong> {{ $data['direccion'] }}</p>
    <p><strong>Matrícula:</strong> {{ $data['matricula_inmobiliaria'] }}</p>
    <p><strong>Tipo:</strong> {{ $data['tipo_propiedad'] }} | <strong>Uso:</strong> {{ $data['uso_inmueble'] }}</p>
    <p><strong>Estado:</strong> {{ $data['estado'] }}</p>
    <p><strong>Inquilino:</strong> {{ $data['inquilino'] }} (ID: {{ $data['id_inquilino'] }})</p>

    <hr>

    <p><strong>Arriendo mensual:</strong> ${{ number_format($data['arriendo_mensual']) }}</p>
    <p><strong>Estado de pago:</strong> {{ $data['estado_pago'] }}</p>

    <p><strong>Mantenimiento:</strong> ${{ number_format($data['mantenimiento']) }}</p>
    <p><strong>Administración:</strong> ${{ number_format($data['administracion']) }}</p>
    <p><strong>Impuestos:</strong> ${{ number_format($data['impuestos']) }}</p>
    <p><strong>Servicios públicos:</strong> ${{ number_format($data['servicios_publicos']) }}</p>

    <p><strong>Ingreso mensual:</strong> ${{ number_format($data['ingreso_mensual']) }}</p>
    <p><strong>Egreso mensual:</strong> ${{ number_format($data['egreso_mensual']) }}</p>

    <hr>

    <p><strong>Contrato:</strong> {{ $data['contrato'] }}</p>
    <p><strong>Observaciones:</strong> {{ $data['observaciones'] }}</p>
</body>
</html>
