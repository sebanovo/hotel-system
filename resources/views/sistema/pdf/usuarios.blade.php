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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .reservas-table {
            width: 100%;
            font-size: 0.875rem;
            color: #1f2937;
            background-color: white;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .reservas-table thead {
            background-color: #f3f4f6;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #374151;
        }

        .reservas-table th,
        .reservas-table td {
            padding: 0.75rem 1.5rem;
            text-align: left;
            border-top: 1px solid #e5e7eb;
        }

        .reservas-table td.text-center {
            text-align: center;
        }

        .reservas-table tbody tr:hover {
            background-color: #fef2f2;
            transition: background-color 0.3s ease;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.2s ease;
        }

        .btn.editar {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .btn.editar:hover {
            background-color: #bfdbfe;
        }

        .btn.eliminar {
            background-color: #fee2e2;
            color: #dc2626;
            border: none;
        }

        .btn.eliminar:hover {
            background-color: #fecaca;
        }

        .sin-datos {
            text-align: center;
            padding: 1.5rem;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <h1>Lista de Usuarios</h1>
    <div class="table-container">
        <table class="reservas-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
