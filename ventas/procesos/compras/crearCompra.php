<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Compras.php";
	$obj= new compras();

	

	if (isset($_SESSION['tablaCompras2Temp']) && is_array($_SESSION['tablaCompras2Temp']) && count($_SESSION['tablaCompras2Temp']) > 0) {
		$result = $obj->crearCompra();
		unset($_SESSION['tablaCompras2Temp']);
		echo $result;
	} else {
		echo 0;
	}
 ?>