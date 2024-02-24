<?php
require_once "../../clases/Conexion.php";

$c = new conectar();
$conexion = $c->conexion();

if (isset($_POST['nombre'])) {
    $nombreProducto = $_POST['nombre'];

    $sql = "SELECT art.nombre,
                    art.descripcion,
                    art.cantidad,
                    art.precio,
                    img.ruta,
                    cat.nombreCategoria,
                    art.id_producto
          FROM articulos AS art 
          INNER JOIN imagenes AS img ON art.id_imagen = img.id_imagen
          INNER JOIN categorias AS cat ON art.id_categoria = cat.id_categoria
          WHERE art.nombre LIKE '%$nombreProducto%'";

    $result = mysqli_query($conexion, $sql);

    if ($result) { ?>
        <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
            <caption><label>Resultados de la búsqueda</label></caption>
            <tr>
                <td>Categoria</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Imagen</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            
            <?php while ($ver = mysqli_fetch_row($result)):?>
                <tr>
                    <td><?php echo $ver[5]; ?></td>
                    <td><?php echo $ver[0]; ?></td>
                    <td><?php echo $ver[1]; ?></td>
                    <td><?php echo $ver[2]; ?></td>
                    <td><?php echo $ver[3]; ?></td>
                    <td>
                        <?php 
                        $imgVer=explode("/", $ver[4]) ; 
                        $imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
                        ?>
                        <img width="80" height="80" src="<?php echo $imgruta ?>">
                    </td>

                    <td>
                        <span  data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[6] ?>')">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </span>
                    </td>
                    <td>
                        <span class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $ver[6] ?>')">
                            <span class="glyphicon glyphicon-remove"></span>
                        </span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php
    }
} else {
    echo 'Error en la consulta SQL: ' . mysqli_error($conexion);
}
?>
