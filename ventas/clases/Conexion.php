<?php
class contectar{
    private $servidor="localhost";
    private $usuario="root";
    private $contraseña="";
    private $bd="BD_compraventa";

    public function conexion(){
        $conexion=mysqli_connect($this->servidor,
        $this->usuario,
        $this->contraseña,
        $this->bd;)

        return $conexion;
    }
}

$obj=new conectar
var_dump($obj->conexion)

?>