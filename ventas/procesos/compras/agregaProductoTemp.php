<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idproveedor=$_POST['proveedorCompra'];
	$idproducto=$_POST['productoCompra'];
	$idusuario=$_POST['usuarioC'];
	$descripcion=$_POST['descripcionC'];
	$cantidad=$_POST['cantidadC'];
	$precio=$_POST['precioC'];

	$sql="SELECT nombre_empresa
			from proveedores 
			where id_proveedor='$idproveedor'";

	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$nproveedor=$c[0];

	$sql="SELECT nombre 
			from articulos 
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||".
				$nombreproducto."||".
				$descripcion."||".
				$precio."||".
				$nproveedor."||".
				$idproveedor;

	$_SESSION['tablaCompras2Temp'][]=$articulo;

 ?>