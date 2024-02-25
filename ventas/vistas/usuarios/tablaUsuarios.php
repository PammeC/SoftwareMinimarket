<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();


	// Función para ejecutar la consulta y mostrar la tabla
	function ejecutarConsulta($conexion, $sql)
	{
		$result = mysqli_query($conexion, $sql);

		if ($result) {
			?>
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
			<caption><label>Usuarios </label></caption>
			<tr>
				<td>Nombre</td>
				<td>Apellido</td>
				<td>Usuario</td>
				<td>Editar</td>
				<td>Eliminar</td>
			</tr>

			<?php while($ver=mysqli_fetch_row($result)): ?>

			<tr>
				<td><?php echo $ver[1]; ?></td>
				<td><?php echo $ver[2]; ?></td>
				<td><?php echo $ver[3]; ?></td>
				<td>
					<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
						<span class="glyphicon glyphicon-pencil"></span>
					</span>
				</td>
				<td>
					<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
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
if (isset($_POST['Email'])) {
    $Email = $_POST['Email'];

    $sql = "SELECT id_usuario, 
                    nombre,
                    apellido,
                    email,
                    fechaCaptura
            FROM usuarios
            WHERE Email LIKE '%$Email%'";
	ejecutarConsulta($conexion, $sql);
} else {

	$sql="SELECT id_usuario,
					nombre,
					apellido,
					email
			from usuarios";
	 ejecutarConsulta($conexion, $sql);
}
?>
	