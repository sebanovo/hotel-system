<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Hotel Paraíso</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        body {
            background-image: url('/storage/imagen.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }

        .bg-cover {
            background-image: url('https://images.unsplash.com/photo-1501117716987-c8e1ecb210c9?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            position: relative;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            top: 40%;
            transform: translateY(-50%);
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-content p {
            font-size: 1.25rem;
        }

        nav.navbar {
            z-index: 3;
        }
    </style>
</head>
<body>
    <div class="bg-cover">
        <div class="overlay"></div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top px-4">
            <a class="navbar-brand fw-bold text-white" href="#">Hotel Paraíso</a>
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-light">Registrarse</a>
            </div>
        </nav>

        <div class="container hero-content text-white">
            <h1>Bienvenido al Hotel Paraíso</h1>
            <p>Descansa, disfruta y déjate llevar por la experiencia única que ofrecemos.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
