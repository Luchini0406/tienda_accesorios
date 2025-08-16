<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Compra</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<header><h1>Registrar Compra / Entrada de Producto</h1></header>
<div class="sidebar">
    <a href="index.php">Inicio</a>
    <a href="productos.php">Inventario</a>
    <a href="ventas.php">Registrar Venta</a>
    <a href="historial_movimientos.php">Historial</a>
</div>
<main style="margin-left:210px; padding: 1rem;">
<form method="post" enctype="multipart/form-data">
    <h2>Formulario de Compra</h2>
    <label>Código: <input type="text" name="codigo" required></label><br><br>
    <label>Nombre: <input type="text" name="nombre" required></label><br><br>
    <label>Descripción: <textarea name="descripcion" required></textarea></label><br><br>
    <label>Precio Compra: <input type="number" step="0.01" name="precio_compra" required></label><br><br>
    <label>Precio Venta: <input type="number" step="0.01" name="precio_venta" required></label><br><br>
    <label>Categoría: <input type="text" name="categoria" required></label><br><br>
    <label>Cantidad a ingresar: <input type="number" name="cantidad" required></label><br><br>
    <label>Imagen del producto: <input type="file" name="imagen" accept="image/*"></label><br><br>
    <input type="submit" value="Registrar Compra" name="comprar" class="btn">
</form>
<script>
document.querySelector("input[name='categoria']").addEventListener("blur", function() {
    const categoria = this.value.toUpperCase();
    let prefijo = "";

    if (categoria.includes("CEL")) {
        prefijo = "CEL";
    } else if (categoria.includes("PC")) {
        prefijo = "PC";
    } else {
        prefijo = "GEN"; // categoría general
    }

    fetch("codigo_sugerido.php?prefijo=" + prefijo)
        .then(response => response.text())
        .then(data => {
            document.querySelector("input[name='codigo']").value = data;
        });
});
</script>

<?php
if (isset($_POST['comprar'])) {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $categoria = $_POST['categoria'];
    $cantidad = (int)$_POST['cantidad'];
    $imagen = '';

    // Verificar si ya existe
    $existe = $conn->query("SELECT * FROM productos WHERE codigo = '$codigo'")->fetch_assoc();

    if (!empty($_FILES['imagen']['name'])) {
        $imagen = basename($_FILES['imagen']['name']);
        $ruta = "img/productos/" . $imagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
    } else {
        // Si no se sube imagen nueva, usar la existente o dejar vacío
        $imagen = $existe ? $existe['imagen'] : '';
    }

    if ($existe) {
        // Si existe, actualizar stock y otros datos si se desean
        $nuevo_stock = $existe['stock'] + $cantidad;
        $conn->query("UPDATE productos SET 
            nombre = '$nombre',
            descripcion = '$descripcion',
            precio_compra = $precio_compra,
            precio_venta = $precio_venta,
            categoria = '$categoria',
            imagen = '$imagen',
            stock = $nuevo_stock
        WHERE id = {$existe['id']}");

        // Historial de entrada
        $conn->query("INSERT INTO historial_movimientos (producto_id, tipo_movimiento, cantidad)
                      VALUES ({$existe['id']}, 'entrada', $cantidad)");

        echo "<p style='color:limegreen;'>✔ Producto actualizado y compra registrada.</p>";
    } else {
        // Insertar nuevo producto
        $conn->query("INSERT INTO productos 
            (codigo, nombre, descripcion, precio_compra, precio_venta, stock, categoria, imagen)
            VALUES 
            ('$codigo', '$nombre', '$descripcion', $precio_compra, $precio_venta, $cantidad, '$categoria', '$imagen')");

        $nuevo_id = $conn->insert_id;

        // Historial de entrada
        $conn->query("INSERT INTO historial_movimientos (producto_id, tipo_movimiento, cantidad)
                      VALUES ($nuevo_id, 'entrada', $cantidad)");

        echo "<p style='color:limegreen;'>✔ Nuevo producto agregado correctamente.</p>";
    }
}
?>
</main>
</body>
</html>
