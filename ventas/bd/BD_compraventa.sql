CREATE SCHEMA ventascompras DEFAULT CHARACTER SET utf8mb4 ;
use ventascompras;

CREATE TABLE persona (
    id_persona INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) ,
    apellido VARCHAR(50) ,
    cedula VARCHAR(15) ,
    telefono VARCHAR(15),
    correo VARCHAR(50),
    direccion VARCHAR(100)
);

CREATE TABLE cliente (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona)
);

CREATE TABLE empleado (
    id_empleado INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    salario FLOAT,
    fecha_contratacion DATE,
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona)
);

CREATE TABLE proveedor (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    empresa VARCHAR(50),
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona)
);

CREATE TABLE rol (
    id_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    descripcion VARCHAR(100),
    permisos VARCHAR(255)
);

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    id_rol INT,
    usuario VARCHAR(20),
    contraseña VARCHAR(10) ,
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona),
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE producto (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    descripcion VARCHAR(255),
    cantidad INT,
    categoria VARCHAR(50),
    precio FLOAT,
    fecha_caducidad DATE
);

CREATE TABLE inventario (
    id_inventario INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_producto INT,
    fecha_entrada DATE,
    fecha_salida DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

CREATE TABLE factura (
    id_factura INT PRIMARY KEY AUTO_INCREMENT,
    fecha_factura DATE,
    metodo_pago VARCHAR(20),
    confirmacion_pago BOOLEAN,
    precio_total FLOAT
);

CREATE TABLE transaccion (
    id_transaccion INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT,
    id_factura INT,
    cantidad INT,
    fecha DATE,
    precio_total FLOAT,
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona),
    FOREIGN KEY (id_factura) REFERENCES factura(id_factura)
);

CREATE TABLE compra (
    id_compra INT PRIMARY KEY AUTO_INCREMENT,
    id_transaccion INT,
    FOREIGN KEY (id_transaccion) REFERENCES transaccion(id_transaccion)
);

CREATE TABLE venta (
    id_venta INT PRIMARY KEY AUTO_INCREMENT,
    id_transaccion INT,
    FOREIGN KEY (id_transaccion) REFERENCES transaccion(id_transaccion)
);

CREATE TABLE linea_compra (
    id_lineaCompra INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT,
    id_compra INT,
    cantidad INT,
    precio_total FLOAT,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
    FOREIGN KEY (id_compra) REFERENCES compra(id_compra)
);

CREATE TABLE linea_venta (
    id_lineaVenta INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT,
    id_venta INT,
    cantidad INT,
    precio_total FLOAT,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
    FOREIGN KEY (id_venta) REFERENCES venta(id_venta)
);

CREATE TABLE devoluciones_proveedores (
    id_devolucion INT PRIMARY KEY AUTO_INCREMENT,
    id_compra INT,
    fecha_devolucion DATE,
    motivo_devolucion VARCHAR(255),
    FOREIGN KEY (id_compra) REFERENCES compra(id_compra)
);


