<?php
require_once "../../clases/Conexion.php";
$c = new conectar();
$conexion = $c->conexion();

// Obtener el ID de la categoría seleccionada
$idCategoria = $_POST['idCategoria'];

// Consulta SQL para obtener productos por categoría
$sql = "SELECT id_producto, nombre FROM articulos WHERE id_categoria = '$idCategoria'";
$result = mysqli_query($conexion, $sql);

// Construir opciones para el campo de selección de productos
while ($producto = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $producto['id_producto'] . '">' . $producto['nombre'] . '</option>';
}

echo $options;
?>
