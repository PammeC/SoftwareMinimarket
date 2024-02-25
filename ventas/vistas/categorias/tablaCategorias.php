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
				<caption><label>Categorias</label></caption>
				<tr>
					<td>Categoria</td>
					<td>Editar</td>
					<td>Eliminar</td>
				</tr>

				<?php
				while ($ver=mysqli_fetch_row($result)):
				?>

				<tr>
					<td><?php echo $ver[1] ?></td>
					<td>
						<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#actualizaCategoria" onclick="agregaDato('<?php echo $ver[0] ?>','<?php echo $ver[1] ?>')">
							<span class="glyphicon glyphicon-pencil"></span>
						</span>
					</td>
					<td>
						<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $ver[0] ?>')">
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
if (isset($_POST['nombre'])) {
    $nombreCategoria = $_POST['nombre'];

	$sql="SELECT id_categoria,nombreCategoria 
			FROM categorias
			WHERE nombreCategoria LIKE '%$nombreCategoria%'";
	ejecutarConsulta($conexion, $sql);
} else {
	$sql="SELECT id_categoria,nombreCategoria 
			FROM categorias";
	ejecutarConsulta($conexion, $sql);
}
?>


