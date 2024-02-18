<?php
// Incluir la conexión a la base de datos y otras clases necesarias
require_once "../../clases/Conexion.php";

// Crear una instancia de la conexión
$c = new conectar();
$conexion = $c->conexion();

// Realizar la consulta para obtener productos ordenados por categoría
$sql = "SELECT art.nombre,
                art.descripcion,
                art.cantidad,
                art.precio,
                img.ruta,
                cat.nombreCategoria,
                art.id_producto
        FROM articulos as art 
        INNER JOIN imagenes as img ON art.id_imagen=img.id_imagen
        INNER JOIN categorias as cat ON art.id_categoria=cat.id_categoria
        ORDER BY cat.nombreCategoria, art.nombre";

$result = mysqli_query($conexion, $sql);

// Construir la tabla con los resultados
$table = '<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
            <caption><label>Productos</label></caption>
            <tr>
                <td>Categoria</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Imagen</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>';

while ($ver = mysqli_fetch_row($result)) {
    $imgVer = explode("/", $ver[4]);
    $imgruta = $imgVer[1] . "/" . $imgVer[2] . "/" . $imgVer[3];

    $table .= '<tr>
                    <td>' . $ver[5] . '</td>
                    <td>' . $ver[0] . '</td>
                    <td>' . $ver[1] . '</td>
                    <td>' . $ver[2] . '</td>
                    <td>' . $ver[3] . '</td>
                    <td><img width="80" height="80" src="' . $imgruta . '"></td>
                    
                    <td>
                        <span data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo(\'' . $ver[6] . '\')">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                    </td>
                    <td>
                        <span class="btn btn-danger btn-xs" onclick="eliminaArticulo(\'' . $ver[6] . '\')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </td>
                </tr>';
}

$table .= '</table>';

// Imprimir la tabla
echo $table;
?>
