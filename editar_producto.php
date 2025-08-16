<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
    die("ID de producto no especificado.");
}

$id = $_GET['id'];
$resultado = $conn->query("SELECT * FROM productos WHERE id = $id");

if ($resultado->num_rows == 0) {
    die("Producto no encontrado.");
}

$producto = $resultado->fetch_assoc();

if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];
    $imagen = $producto['imagen'];

    // Si se sube nueva imagen
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], "img/productos/" . $imagen);
    }

    $conn->query("UPDATE productos SET
        nombre = '$nombre',
        descripcion = '$descripcion',
        precio_compra = $precio_compra,
        precio_venta = $precio_venta,
        categoria = '$categoria',
        stock = $stock,
        imagen = '$imagen'
        WHERE id = $id");

    echo "<p style='color:limegreen;'>✔ Producto actualizado correctamente.</p>";
    echo "<a href='productos.php'>⬅ Volver al Inventario</a>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<h2>Editar Producto: <?php echo $producto['nombre']; ?></h2>
<form method="post" enctype="multipart/form-data">
    <label>Nombre: <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required></label><br><br>
    <label>Descripción: <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea></label><br><br>
    <label>Precio Compra: <input type="number" step="0.01" name="precio_compra" value="<?php echo $producto['precio_compra']; ?>" required></label><br><br>
    <label>Precio Venta: <input type="number" step="0.01" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>" required></label><br><br>
    <label>Categoría: <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>" required></label><br><br>
    <label>Stock: <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required></label><br><br>
    <label>Imagen Actual: <br><img src="img/productos/<?php echo $producto['imagen']; ?>" width="100"></label><br><br>
    <label>Cambiar Imagen: <input type="file" name="imagen"></label><br><br>
    <input type="submit" name="actualizar" value="Actualizar Producto" class="btn">
</form>
</body>
</html>
