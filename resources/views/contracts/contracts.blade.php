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
    <p><strong>Propietario:</strong> {{ $contrato['propietario'] }}</p>
    <p><strong>Inquilino:</strong> {{ $contrato['inquilino'] }}</p>
    <p><strong>Fecha:</strong> {{ $contrato['fecha'] }}</p>
    <hr>
    <p>{{ $contrato['detalles'] }}</p>
</body>
</html>
