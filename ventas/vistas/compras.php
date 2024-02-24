<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>compras</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Compra de productos</h1>
			<div class="row">
				<div class="col-sm-12">
					<span class="btn btn-default" id="compraProductosBtn">Comprar producto</span>
					<span class="btn btn-default" id="comprasHechasBtn">Compras hechas</span>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">			 
					<div id="compraProductos"></div>
					<div id="comprasHechas"></div>
				</div>
			</div>
		</div>
	</body>
</html>
	<script type="text/javascript">
		$(document).ready(function(){	

			$('#compraProductosBtn').click(function(){
				esconderSeccionCompra();
				$('#compraProductos').load('compras/comprasDeProductos.php');
				$('#compraProductos').show();
			});
			$('#comprasHechasBtn').click(function(){
				esconderSeccionCompra();
				$('#comprasHechas').load('compras/comprasyReportes.php');
				$('#comprasHechas').show();
			});
		});
		function esconderSeccionCompra(){			
			$('#compraProductos').hide();
			$('#comprasHechas').hide();
		}
	</script>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>