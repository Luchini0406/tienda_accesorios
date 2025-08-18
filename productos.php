<?php
include 'conexion.php';

// Obtener productos
$sql = "SELECT * FROM productos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de Productos</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1c1c2b;
            color: #f5f5f5;
            margin: 0;
        }

        header {
            background-color: #111;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        header h1 {
            color: #00ffe0;
        }

        .sidebar {
            background-color: #151523;
            padding: 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.4);
        }

        .sidebar a {
            display: block;
            color: #00ffe0;
            text-decoration: none;
            margin: 10px 0;
            font-weight: bold;
        }

        main {
            margin-left: 220px;
            padding: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2e2e42;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #444;
        }

        th {
            background-color: #00ffe0;
            color: #000;
        }

        tr:hover {
            background-color: #3e3e55;
        }

        img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: zoom-in;
            transition: 0.2s;
        }

        img:hover {
            transform: scale(1.05);
        }

        .btn-editar {
            background-color: #00c3ff;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-editar:hover {
            background-color: #00a3d1;
        }

        /* Modal */
        #modalImagen {
            display: none;
            position: fixed;
            z-index: 999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            justify-content: center;
            align-items: center;
        }

        #modalImagen img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(255,255,255,0.2);
        }

        #modalImagen span {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 40px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <h1>Inventario de Productos</h1>
</header>

<div class="sidebar">
    <a href="index.php">🏠 Inicio</a>
    <a href="compras.php">📥 Registrar Compra</a>
    <a href="ventas.php">📤 Registrar Venta</a>
    <a href="historial_movimientos.php">📊 Ver Historial</a>
</div>

<main>
    <h2>Lista de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['codigo']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['descripcion']}</td>
                            <td><img src='img/productos/{$row['imagen']}' alt='Producto' onclick=\"ampliarImagen(this.src)\"></td>
                            <td>{$row['categoria']}</td>
                            <td>{$row['stock']}</td>
                            <td>Bs " . number_format($row['precio_compra'], 2) . "</td>
                            <td>Bs " . number_format($row['precio_venta'], 2) . "</td>
                            <td><a class='btn-editar' href='editar_producto.php?id={$row['id']}'>✏️ Editar</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay productos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<!-- Modal para imagen ampliada -->
<div id="modalImagen" onclick="cerrarModal()" style="display:none;">
    <span onclick="cerrarModal()">×</span>
    <img id="imgGrande" src="">
</div>

<script>
function ampliarImagen(src) {
    document.getElementById('imgGrande').src = src;
    document.getElementById('modalImagen').style.display = 'flex';
}
function cerrarModal() {
    document.getElementById('modalImagen').style.display = 'none';
}
</script>

</body>
</html>
