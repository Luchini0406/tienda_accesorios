<?php
include 'conexion.php';

$prefijo = isset($_GET['prefijo']) ? $_GET['prefijo'] : 'GEN';

// Buscar el último código con ese prefijo
$sql = "SELECT codigo FROM productos WHERE codigo LIKE '$prefijo%' ORDER BY id DESC LIMIT 1";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    // Extraer el número y sumar 1
    $num = (int) preg_replace('/[^0-9]/', '', $row['codigo']);
    $nuevo_codigo = $prefijo . str_pad($num + 1, 3, '0', STR_PAD_LEFT);
} else {
    // Si no existe ninguno aún
    $nuevo_codigo = $prefijo . "001";
}

echo $nuevo_codigo;
?>
