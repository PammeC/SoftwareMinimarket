CREATE SCHEMA `ventas` DEFAULT CHARACTER SET utf8mb4 ;

use ventas;

create table usuarios(
				id_usuario int auto_increment,
				nombre varchar(50),
				apellido varchar(50),
				email varchar(50),
				password text(50),
				fechaCaptura date,
				primary key(id_usuario)
					);

create table categorias (
				id_categoria int auto_increment,
				id_usuario int not null,
				nombreCategoria varchar(150),
				fechaCaptura date,
				primary key(id_categoria)
						);

create table imagenes(
				id_imagen int auto_increment,
				id_categoria int not null,
				nombre varchar(500),
				ruta varchar(500),
				fechaSubida date,
				primary key(id_imagen)
					);

create table articulos(
				id_producto int auto_increment,
				id_categoria int not null,
				id_imagen int not null,
				id_usuario int not null,
				nombre varchar(50),
				descripcion varchar(500),
				cantidad int,
				precio float,
				fechaCaptura date,
				primary key(id_producto)
						);

create table clientes(
				id_cliente int auto_increment,
				id_usuario int not null,
				nombre varchar(200),
				apellido varchar(200),
				direccion varchar(200),
				email varchar(200),
				telefono varchar(200),
				rfc varchar(200),
				primary key(id_cliente)
					);

CREATE TABLE proveedores (
				id_proveedor INT AUTO_INCREMENT,
				id_usuario INT NOT NULL,
				nombre_empresa VARCHAR(200),
				direccion_empresa VARCHAR(200),
				email_empresa VARCHAR(200),
				telefono_empresa VARCHAR(200),
				primary key(id_proveedor)
			); 			

create table ventas(
				id_venta int not null,
				id_cliente int,
				id_producto int,
				id_usuario int,
				precio float,
				fechaCompra date
					);
