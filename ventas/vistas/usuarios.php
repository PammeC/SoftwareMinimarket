<?php 
session_start();
if(isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin'){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar usuarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<label>Buscar Usuario</label>			
						<input type="text" class="form-control" id="buscarEmail" placeholder="Usuario">
						<p></p>
						<span class="btn btn-primary" id="btnBuscarUsuario">Buscar</button></span>
						<span class="btn btn-primary" id="btnMostrarUsuario">Mostrar Todos</button></span>
						<p></p>
						<label>Registrar un Nuevo Usuario</label>
						<p></p>	
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" name="apellido" id="apellido">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" name="usuario" id="usuario">
						
						<label>Password</label>
						<input type="password" class="form-control input-sm" name="password" id="password">
						<label>Confirmar Contraseña</label>
						<input type="password" class="form-control input-sm" name="confirmar_password" id="confirmar_password">

						<p></p>
						<span class="btn btn-primary" id="registro">Registrar</span>

					</form>
				</div>
				<div class="col-sm-7">
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['email']);
				}
			});
		}

		function eliminarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo')
			});
		}


	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaUsuario').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Actualizado con exito ");
						}else{
							alertify.error("No se pudo actualizar ");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){
				try {
					 // Validar que nombre y apellido no contengan números
					 var nombre = $('#nombre').val();
					 var apellido = $('#apellido').val();
					if (/\d/.test(nombre) || /\d/.test(apellido)) {
						throw "El nombre y el apellido no deben contener números.";
					}
					
					// Validar email (debe contener @)
					var email = $('#usuario').val();
					if (!email.includes("@")) {
						throw "El email debe contener el formato '@examp.com'.";
					}
					
					// Si todas las validaciones pasan, proceder con el envío del formulario
					var datos=$('#frmClientes').serialize();


				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				// Obtén los valores de las contraseñas
				var password = $('#password').val();
				var confirmar_password = $('#confirmar_password').val();

				// Verifica si las contraseñas coinciden
				if (password !== confirmar_password) {
					alert("Las contraseñas no coinciden. Por favor, verifica.");
					return false;
				}

				// Validar la contraseña según los criterios
				if (!validarContrasena(password)) {
                alert("La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.");
                return false;
            	}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
						//alert(r);

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito");
						}else{
							alertify.error("Fallo al agregar");
						}
					}
				});
			} catch (error) {
					alertify.error(error);
				}
			})
			// Función para validar la contraseña
			function validarContrasena(contrasena) {
            // Al menos 8 caracteres, una letra mayúscula y un número
            var regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
            return regex.test(contrasena);
        }
		})
	</script>
<script type="text/javascript">

$('#btnMostrarUsuario').click(function(){
		// Recargar la tabla con todos los Usuarios
		$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
		// Limpiar el campo de búsqueda
		$('#buscarEmail').val("");
});

// Nueva función para buscar usuarios por el email
$(document).ready(function(){
    $('#btnBuscarUsuario').click(function(){
        var Email = $('#buscarEmail').val();

        if (Email !== "") {
            $.ajax({
                type: "POST",
                data: { Email: Email },
                url: "usuarios/tablaUsuarios.php",
                success: function(response){
                    if (response !== "0") {
                        $('#tablaUsuariosLoad').html(response); // Mostrar la tabla de resultados
                    } else {
                        alertify.warning("Usuario no encontrado");
                    }
                }
            });
        } else {
            alertify.warning("Por favor, ingresa un Nombre de Usuario correcto");
        }
    });
});

</script>

	<?php 
}else{
	header("location:../index.php");
}
?>