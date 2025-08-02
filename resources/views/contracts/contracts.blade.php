<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contrato</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    </style>
</head>
<body>
    <h2>Contrato de Arrendamiento</h2>
    <p><strong>Propietario:</strong> {{ $contracts['propietario'] }}</p>
    <p><strong>Inquilino:</strong> {{ $contracts['inquilino'] }}</p>
    <p><strong>Fecha:</strong> {{ $contracts['fecha'] }}</p>
    <hr>
    <p>{{ $contracts['detalles'] }}</p>
</body>
</html>
