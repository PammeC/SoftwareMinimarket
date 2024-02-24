<?php
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

if (isset($_POST['Email'])) {
    $Email = $_POST['Email'];

    $sql = "SELECT id_usuario, 
                    nombre,
                    apellido,
                    email,
                    fechaCaptura
            FROM usuarios
            WHERE Email LIKE '%$Email%'";

    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result) > 0) {  ?>

        <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
            <tr>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Email</td>
                <td>fechaCaptura</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        <?php while ($ver = mysqli_fetch_row($result)) { ?>                
            <tr>
                <td><?php echo $ver[1]; ?></td>
                <td><?php echo $ver[2]; ?></td>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $ver[4]; ?></td>

                <td>
                    <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalUsuariosUpdate" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                </td>
                <td>
                    <span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
                        <span class="glyphicon glyphicon-remove"></span>
                    </span>
                </td>
            </tr>
    <?php 
    }
} else {
    // No se encontraron resultados
    echo "0";
}
}
