<?php
    require_once "../../clases/Conexion.php";
    require_once "../../clases/Ventas.php";
 
    $objv= new ventas();
 
    $c=new conectar();
    $conexion= $c->conexion();  
    $idventa=$_GET['idventa'];
 
 $sql="SELECT ve.id_venta,
        ve.fechaCompra,
        ve.id_cliente,
        art.nombre,
        art.precio,
        art.descripcion
    from ventas  as ve
    inner join articulos as art
    on ve.id_producto=art.id_producto
    and ve.id_venta='$idventa'";
 
$result=mysqli_query($conexion,$sql);
 
    $ver=mysqli_fetch_row($result);
 
    $folio=$ver[0];
    $fecha=$ver[1];
    $idcliente=$ver[2];
 
 ?>
 
 <!DOCTYPE html>
 <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte de venta</title>
        <link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
       
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
            }
            .container {
                max-width: 800px;
                margin: auto;
            }
            h1 {
                text-align: center;
                color: #007bff;
            }
            .info-table {
                margin-bottom: 20px;
            }
            .info-table td {
                border: none;
            }
            .products-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            .products-table th, .products-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .products-table th {
                background-color: #f2f2f2;
            }
            .total-row {
                font-weight: bold;
            }
        </style>
    </head>
   
    <body>
        <div class="container">
        <h1>Reporte de Venta</h1>
 
        <table class="table info-table">
            <tr>
                <td>Fecha: <?php echo $fecha; ?></td>
            </tr>
            <tr>
                <td>Folio: <?php echo $folio; ?></td>
            </tr>
            <tr>
                <td>Cliente: <?php echo $objv->nombreCliente($idcliente); ?></td>
            </tr>
 
        </table>
 
 
        <table class="table products-table">
            <thead>
                <tr>
                    <th>Nombre Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
 
            <?php
            $sql="SELECT ve.id_venta,
                        ve.fechaCompra,
                        ve.id_cliente,
                        art.nombre,
                        art.precio,
                        art.descripcion
                    from ventas  as ve
                    inner join articulos as art
                    on ve.id_producto=art.id_producto
                    and ve.id_venta='$idventa'";
 
            $result=mysqli_query($conexion,$sql);
            $total=0;
            $precio_aumentado = $ver[4] * 1.10;
            $precio_formateado = number_format($precio_aumentado, 2);
 
            while($ver=mysqli_fetch_row($result)):
               
             ?>
                <tr>
                <td><?php echo $ver[3]; ?></td>
                <td><?php echo $precio_formateado; ?></td>
                <td>1</td>
                <td><?php echo $ver[5]; ?></td>
            </tr>
            <?php
                 $total=$total + $precio_formateado ;
            endwhile;
             ?>
             <tr>
             <td colspan="4"> Total=  <?php echo "$".$total; ?></td>
                 
             </tr>
        </table>
    </div>
</body>
 </html>