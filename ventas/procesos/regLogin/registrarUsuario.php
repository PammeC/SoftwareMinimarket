<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios();

	// Verifica que las contraseñas coincidan
	if ($_POST['password'] !== $_POST['confirmar_password']) {
		echo 0; // Devuelve un código que indica que las contraseñas no coinciden
		exit();
	}

	$pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['usuario'],
		$pass
				);

	echo $obj->registroUsuario($datos);

 ?>