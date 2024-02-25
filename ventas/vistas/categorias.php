<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>categorias</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Categorias</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCategorias">
						<label>Buscar Categoria</label>			
						<input type="text" class="form-control" id="buscarCategoria" placeholder="Nombre de Categoria">
						<p></p>
						<span class="btn btn-primary" id="btnBuscarCategoria">Buscar</button></span>
						<span class="btn btn-primary" id="btnMostrarCategoria">Mostrar Todos</button></span>
						<p></p>

						<label>Registrar una Nueva Categoria</label>
						<input type="text" class="form-control input-sm" name="categoria" id="categoria">
						<p></p>
						<span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
						<p></p>

						

					</form>
				</div>
				<div class="col-sm-6">
					<div id="tablaCategoriaLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");

			$('#btnAgregaCategoria').click(function(){

				vacios=validarFormVacio('frmCategorias');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmCategorias').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/agregaCategoria.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmCategorias')[0].reset();

					$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
					alertify.success("Categoria agregada con exito");
				}else{
					alertify.error("No se pudo agregar categoria");
				}
			}
		});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCategoria').click(function(){

				datos=$('#frmCategoriaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/actualizaCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Actualizado con exito");
						}else{
							alertify.error("no se pudo actaulizar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function agregaDato(idCategoria,categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
		}

		function eliminaCategoria(idcategoria){
			alertify.confirm('¿Desea eliminar esta categoria?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategoria=" + idcategoria,
					url:"../procesos/categorias/eliminarCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo!')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnBuscarCategoria').click(function(){
				var nombreCategoria = $('#buscarCategoria').val();
				buscarCategoria(nombreCategoria);
			});
			$('#btnMostrarCategoria').click(function(){
				mostrarTodosCategorias();
			});

			function buscarCategoria(nombreCategoria){
				if (nombreCategoria !== "") {
				$.ajax({
					type:"POST",
					data: { nombre: nombreCategoria },
					url:"categorias/tablaCategorias.php",
					success:function(data){
						$('#tablaCategoriaLoad').html(data);
					}
				});
				} else {				
					alertify.warning("Por favor, ingresa un Nombre de Categoria correcto");
				}
			}

			function mostrarTodosCategorias(){
				$.ajax({
					url:"categorias/tablaCategorias.php",
					success:function(data){
						$('#tablaCategoriaLoad').html(data);
					}
				});
			}
		});
	</script>



	<?php 
}else{
	header("location:../index.php");
}
?>