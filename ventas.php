<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Venta</title><link rel="stylesheet" href="css/estilo.css"></head>
<body>
<header><h1>Registrar Venta</h1></header>
<div class="sidebar"><a href="index.php">Inicio</a><a href="productos.php">Inventario</a><a href="compras.php">Registrar Compra</a></div>
<main style="margin-left:210px; padding: 1rem;">
<form method="post">
    <h2>Venta de Producto</h2>
    <label>Código: <input type="text" name="codigo"></label><br><br>
    <label>Cantidad: <input type="number" name="cantidad"></label><br><br>
    <input type="submit" value="Registrar Venta" name="vender" class="btn">
</form>
<?php
if (isset($_POST['vender'])) {
    $codigo = $_POST['codigo'];
    $cantidad = (int)$_POST['cantidad'];
    $producto = $conn->query("SELECT * FROM productos WHERE codigo = '$codigo'")->fetch_assoc();
    if ($producto) {
        if ($producto['stock'] >= $cantidad) {
            $nuevo_stock = $producto['stock'] - $cantidad;
            $conn->query("UPDATE productos SET stock = $nuevo_stock WHERE id = {$producto['id']}");
            echo "<p>Venta registrada correctamente.</p>";
        } else {
            echo "<p>No hay suficiente stock.</p>";
        }
    } else {
        echo "<p>Producto no encontrado.</p>";
    }
}
?>
</main></body></html>