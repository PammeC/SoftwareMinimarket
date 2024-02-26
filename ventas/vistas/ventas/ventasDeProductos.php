<?php 

require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
?>


<h4>Vender un producto</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmVentasProductos">
			<label>Seleciona Cliente</label>
			<select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
				<option value="A">Selecciona</option>
				<?php
				$sql="SELECT id_cliente,nombre,apellido 
				from clientes";
				$result=mysqli_query($conexion,$sql);
				while ($cliente=mysqli_fetch_row($result)):
				?>
				<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Categoría</label>
			<select class="form-control input-sm" id="categoriaVenta" name="categoriaVenta">
				<option value="A">Selecciona</option>
				<?php
				$sql = "SELECT id_categoria, nombreCategoria FROM categorias";
				$result = mysqli_query($conexion, $sql);
				while ($categoria = mysqli_fetch_row($result)):
				?>
					<option value="<?php echo $categoria[0] ?>"><?php echo $categoria[1]?></option>
				<?php endwhile; ?>
			</select>
			<label>Producto</label>
			<select class="form-control input-sm" id="productoVenta" name="productoVenta">
				<option value="A">Selecciona</option>
				<?php
				$sql="SELECT id_producto,
				nombre
				from articulos";
				$result=mysqli_query($conexion,$sql);

				while ($producto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<label>Descripcion</label>
			<textarea readonly="" id="descripcionV" name="descripcionV" class="form-control input-sm"></textarea>
			<label>Cantidad</label>
			<input readonly="" type="text" class="form-control input-sm" id="cantidadV" name="cantidadV">
			<label>Precio</label>
			<input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV">
			<p></p>
			<span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProducto"></div>
	</div>
	<div class="col-sm-4">
		<div id="tablaVentasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

		$('#productoVenta').change(function(){
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoVenta').val(),
				url:"../procesos/ventas/llenarFormProducto.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#descripcionV').val(dato['descripcion']);
					$('#cantidadV').val(dato['cantidad']);
					$('#precioV').val(dato['precio']);

					$('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />');
				}
			});
		});

		$('#categoriaVenta').change(function(){
            var categoriaSeleccionada = $(this).val();
            $.ajax({
                type: "POST",
                data: "idCategoria=" + categoriaSeleccionada,
                url: "../procesos/categorias/obtenerProductosPorCategoria.php",
                success: function(data){

					$('#productoVenta').empty().append('<option value="A">Selecciona</option>' + data);
                }
            });
        });


		$('#btnAgregaVenta').click(function(){
			vacios=validarFormVacio('frmVentasProductos');

			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmVentasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ventas/agregaProductoTemp.php",
				success:function(r){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				}
			});
		});

		$('#btnVaciarVentas').click(function(){

		$.ajax({
			url:"../procesos/ventas/vaciarTemp.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/ventas/quitarproducto.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				alertify.success("Se quito el producto ");
			}
		});
	}

	function crearVenta() {
    $.ajax({
        url: "../procesos/ventas/crearVenta.php",
        success: function (r) {
		//alert(r);
            if (r > 0) {
                $('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
                $('#frmVentasProductos')[0].reset();
                alertify.alert("Venta creada con éxito, consulta la información en ventas hechas");
            } else if (r == 0) {
                alertify.alert("No hay lista de venta!!");
            } else {
                alertify.error("No se pudo crear la venta. Detalles del error: " + r);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var errorMessage = "Error al intentar crear la venta. ";

            // Verifica si hay un mensaje específico en la respuesta JSON
            if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                errorMessage += jqXHR.responseJSON.message;
            } else {
                // Si no hay un mensaje específico, agrega un mensaje genérico
                errorMessage += "Consulta la consola para más detalles.";
            }

            // Imprime el error en la consola del navegador
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);

            // Muestra el mensaje de error detallado con alertify
            alertify.error(errorMessage);
        }
    });
}

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#categoriaVenta').select2();
		$('#productoVenta').select2();

	});
</script>