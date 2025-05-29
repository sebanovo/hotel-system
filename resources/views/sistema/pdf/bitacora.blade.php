<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: DejaVu Sans
        }

        .table-container {
            overflow-x: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            animation: fadeInUp 0.5s ease-in-out;
        }

        .table {
            font-size: 0.875rem;
            color: #1f2937;
            background-color: white;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .table thead {
            background-color: #f3f4f6;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #374151;
        }

        .table th,
        .table td {
            padding: 0.75rem 1.5rem;
            text-align: left;
            border-top: 1px solid #e5e7eb;
        }

        .table td.text-center {
            text-align: center;
        }

        .table tbody tr:hover {
            background-color: #fef2f2;
            transition: background-color 0.3s ease;
        }
    </style>
</head>

<body>
    <h1>Bitacora</h1>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>IP</th>
                    <th>Acción</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bitacoras as $bitacora)
                    <tr>
                        <td>{{ $bitacora->id }}</td>
                        <td>{{ $bitacora->user->name ?? 'Usuario eliminado' }}</td>
                        <td>{{ $bitacora->user->email ?? 'N/A' }}</td>
                        <td>{{ $bitacora->ip }}</td>
                        <td>{{ $bitacora->accion }}</td>
                        <td>{{ $bitacora->created_at->format('d/m/Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
