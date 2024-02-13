<?php 
 
class compras{
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT 
				    art.nombre,
				    art.descripcion,
				    art.cantidad,
				    img.ruta,
				    art.precio
				FROM
				    articulos AS art
				        INNER JOIN
				    imagenes AS img ON art.id_imagen = img.id_imagen
				        AND art.id_producto = '$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$data=array(
			'nombre' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'ruta' => $img,
			'precio' => $ver[4]
		);		
		return $data;
	}

	public function creaFolio(){
		$c = new conectar();
		$conexion = $c->conexion();
	
		$sql = "SELECT id_compra FROM compras ORDER BY id_compra DESC LIMIT 1";
	
		$result = mysqli_query($conexion, $sql);
	
		if (!$result) {
			// Manejar el error, por ejemplo:
			echo "Error en la consulta SQL: " . mysqli_error($conexion);
			return 0;
		}
	
		$id = mysqli_fetch_row($result)[0];
	
		if ($id === "" || $id === null || $id === 0) {
			return 1;
		} else {
			return $id + 1;
		}
	}


	public function crearCompra(){
		$c = new conectar();
		$conexion = $c->conexion();
	 
		$fecha = date('Y-m-d');
		$idcompra = self::creaFolio();
		$datos = $_SESSION['tablaCompras2Temp'];
		$idusuario = $_SESSION['iduser'];
		$r = 0;

		for ($i = 0; $i < count($datos); $i++) { 
			$d = explode("||", $datos[$i]);
	
			$sql = "INSERT into compras (id_compra,
										id_proveedor,
										id_producto,
										id_usuario,
										precio,
										fechaCompra)
							values ('$idcompra',
									'$d[5]',
									'$d[0]',
									'$idusuario',
									'$d[3]',
									'$fecha')";
			$result = mysqli_query($conexion, $sql);
	
			$cantidadEnStock = $this->obtenerCantidadEnStock($d[0]);

            // Verificar si hay suficiente cantidad en stock
            if ($cantidadEnStock >= 1) {
                // Restar la cantidad vendida al stock actual del producto
                $nuevaCantidad = $cantidadEnStock + 1;
                $this->actualizarCantidadEnStock($d[0], $nuevaCantidad);
                $r = $r + 1;
			 } else {
			 	error_log("Error al ejecutar la consulta: " . mysqli_error($conexion));
			 }
		}
	
		return $r;
	}

	public function nombreProveedor($idProveedor){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT nombre_empresa
			from proveedores 
			where id_proveedor='$idProveedor'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0];
	}

	public function obtenerCantidadEnStock($idProducto)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "SELECT cantidad FROM articulos WHERE id_producto = '$idProducto'";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            $ver = mysqli_fetch_row($result);
            return $ver[0];
        } else {
            error_log("Error al obtener la cantidad en stock: " . mysqli_error($conexion));
            return false;
        }
    }

    public function actualizarCantidadEnStock($idProducto, $nuevaCantidad)
    {
        $c = new conectar();
        $conexion = $c->conexion();

        $sql = "UPDATE articulos SET cantidad = '$nuevaCantidad' WHERE id_producto = '$idProducto'";
        $result = mysqli_query($conexion, $sql);

        if (!$result) {
            error_log("Error al actualizar la cantidad en stock: " . mysqli_error($conexion));
        }
    }


	public function obtenerTotal($idcompra){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT precio 
				from compras 
				where id_compra='$idcompra'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}
}

?>