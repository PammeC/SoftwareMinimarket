<?php
require_once "../../clases/Conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

if (isset($_POST['Nombre_Empresa'])) {
    $Nombre_Empresa = $_POST['Nombre_Empresa'];

    $sql = "SELECT id_proveedor, 
                    nombre_empresa,
                    direccion_empresa,
                    email_empresa,
                    telefono_empresa
            FROM proveedores
            WHERE nombre_empresa LIKE '%$Nombre_Empresa%'";

    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result) > 0) {  ?>

        <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
            <tr>
                <td>Nombre Empresa</td>
                <td>Dirección Empresa</td>
                <td>Email Empresa</td>
                <td>Teléfono Empresa</td>
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
                    <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalProveedoresUpdate" onclick="agregaDatosProveedor('<?php echo $ver[0]; ?>')">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                </td>
                <td>
                    <span class="btn btn-danger btn-xs" onclick="eliminarProveedor('<?php echo $ver[0]; ?>')">
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
