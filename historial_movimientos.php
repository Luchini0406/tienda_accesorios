<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Historial de Movimientos</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header>
    <h1>Historial de Movimientos</h1>
</header>
<div class="sidebar">
    <a href="index.php">Inicio</a>
    <a href="productos.php">Inventario</a>
    <a href="compras.php">Registrar Compra</a>
    <a href="ventas.php">Registrar Venta</a>
</div>
<main style="margin-left:210px; padding: 1rem;">
    <h2>Entradas y Salidas de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT 
                        m.fecha, 
                        p.codigo, 
                        p.nombre, 
                        m.tipo_movimiento, 
                        m.cantidad
                    FROM historial_movimientos m
                    JOIN productos p ON m.producto_id = p.id
                    ORDER BY m.fecha DESC";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $color = $row['tipo_movimiento'] == 'entrada' ? 'lime' : 'tomato';
                    echo "<tr>
                            <td>{$row['fecha']}</td>
                            <td>{$row['codigo']}</td>
                            <td>{$row['nombre']}</td>
                            <td style='color:$color; font-weight:bold;'>{$row['tipo_movimiento']}</td>
                            <td>{$row['cantidad']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay movimientos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>
</body>
</html>
