
<?php 
	require_once "../../clases/Conexion.php";

	$obj= new conectar();
	$conexion= $obj->conexion();

	function ejecutarConsulta($conexion, $sql)
	{
		$result = mysqli_query($conexion, $sql);

		if ($result) {
			?>
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
			<caption><label>Proveedores</label></caption>
			<tr>
				<td>Nombre Empresa</td>
				<td>Diereccion Empresa</td>
				<td>Email Empresa</td>
				<td>Telefono Empresa</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>

			<?php while($ver=mysqli_fetch_row($result)): ?>

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
		<?php endwhile; ?>
		</table>
		<?php
		} else {
			echo 'Error en la consulta SQL: ' . mysqli_error($conexion);
		}
	}
	if (isset($_POST['nombre_empresa'])) {
		$nombre_empresa = $_POST['nombre_empresa'];
	
		$sql = "SELECT id_proveedor, 
						nombre_empresa,
						direccion_empresa,
						email_empresa,
						telefono_empresa
				FROM proveedores
				WHERE nombre_empresa LIKE '%$nombre_empresa%'";
	} else {

		$sql="SELECT id_proveedor, 
					nombre_empresa,
					direccion_empresa,
					email_empresa,
					telefono_empresa
			from proveedores";
		ejecutarConsulta($conexion, $sql);
	}
	?>