<?php
class conectar{
    private $servidor="localhost";
    private $usuario="root";
    private $password="1723372148";
    private $bd="ventas";

    public function conexion(){
        $conexion=mysqli_connect($this->servidor,
        $this->usuario,
        $this->password,
        $this->bd);

        return $conexion;
    }
} 
?>