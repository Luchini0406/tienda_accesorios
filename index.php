<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a Luchini Conectando el mundo con principios del Reino</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            color: white;
        }

        header {
            background-color: #111;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }

        header img {
            height: 60px;
        }

        header h1 {
            margin: 0;
            font-size: 1.8rem;
            color: #00ffe0;
            letter-spacing: 1px;
        }

        main {
            padding: 2rem;
            text-align: center;
        }

        .tarjeta {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 2rem;
        }

        .modulo {
            background-color: #1e1e2f;
            border-radius: 15px;
            padding: 2rem;
            width: 250px;
            box-shadow: 0 0 15px rgba(0,255,255,0.2);
            transition: transform 0.3s;
        }

        .modulo:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0,255,255,0.5);
        }

        .modulo a {
            text-decoration: none;
            color: #00ffe0;
            font-weight: bold;
            font-size: 1.1rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #111;
            margin-top: 3rem;
            color: #999;
        }
    </style>
</head>
<body>
<header>
    <img src="img/Logo de Luchini.jpg" alt="Logo">
    <h1>"Luchini"</h1> <h2> Conectando el mundo con principios del Reino</h2>
</header>

<main>
    <h2>Bienvenido al sistema de gestión de inventario, compras y ventas</h2>
    <div class="tarjeta">
        <div class="modulo"><a href="productos.php">📦 Ver Productos</a></div>
        <div class="modulo"><a href="compras.php">📥 Registrar Compra</a></div>
        <div class="modulo"><a href="ventas.php">📤 Registrar Venta</a></div>
        <div class="modulo"><a href="historial_movimientos.php">📊 Ver Historial</a></div>
    </div>
</main>

<footer>
    © 2025 Luchini - Todos los derechos reservados.
</footer>
</body>
</html>
