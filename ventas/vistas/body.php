<!DOCTYPE html>
<html>
<head>
 <title></title>

   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celda con una fila y seis columnas</title>

   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <style>

    h2 {
            text-align: center; /* Centra el texto */
            background-color: #9370DB; /* Fondo de color lila */
            padding: 10px; /* Espaciado interno */
            color: white; /* Texto en color blanco */
        }
          /* Estilos para la tabla */
             table {
            width: 95%; /* Ocupa todo el ancho de la página */
            margin: 30px;
            background-color: white; /* Fondo blanco */
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

         /* Estilos para las imágenes dentro de la tabla */
        .tabla-imagenes img {
            width: 300px; /* Aumenta el tamaño de las imágenes */
            height: auto; /* Altura automática para mantener la proporción */
        }
        
        /* Estilo para las imágenes */
        .img-container {
            padding: 0; /* Eliminar el espacio entre las columnas */
            text-align: center; /* Centrar las imágenes */
        }
        
        .img-container img {
            max-width: 100%; /* Ancho máximo de la imagen */
            margin-bottom: 20px; /* Espacio entre las imágenes */
        }

        .carousel-item img {
            width: 100%;
            height: auto;
        } 
        
        .carousel-item img {
            width: 100%;
            height: auto;
        }
        .slick-carousel img {
    max-width: 100%; 
    height: 400px; /* Altura fija */
    object-fit: cover; /* Recorta y ajusta la imagen dentro del contenedor */
}
 /* Estilos para la imagen FONDO1 */
        .full-width-image {
            width: 100%; /* Ocupa todo el ancho disponible */
            height: auto; /* Altura automática para mantener la proporción */
            display: block; /* Para eliminar el espacio adicional */
            float: left; 
        }

     /* Estilos para el footer */
        footer {
            background-color: #9370DB		; /* Fondo color lila */
            padding: 30px 0; /* Espaciado interno superior e inferior */
            color: white; /* Texto en color blanco */
        }

        footer h3 {
            color: black; /* Título en color blanco */
        }

        footer ul {
            list-style: none; /* Quita los puntos de la lista */
            padding-left: 0; /* Quita el espacio interno izquierdo */
        }

        footer ul li {
            margin-bottom: 10px; /* Espaciado inferior entre elementos de la lista */
        }

        footer ul li a {
            color: white; /* Enlaces en color blanco */
            text-decoration: none; /* Quita la subrayado de los enlaces */
        }

        footer ul li a:hover {
            text-decoration: underline; /* Subrayado al pasar el mouse sobre los enlaces */
        }

        footer p {
            margin-top: 20px; /* Espaciado superior */
            text-align: center; /* Centra el texto */
            color: #black; /* Color lila */
        }

        footer hr {
            border-top: 1px solid white; /* Línea divisoria */
            margin-top: 20px; /* Espaciado superior */
            margin-bottom: 20px; /* Espaciado inferior */
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Carrusel de Bootstrap -->
        <div class="slick-carousel">
            <div><img src="../img/oferta3.jpg" alt="Imagen 1"></div>
            <div><img src="../img/oferta5.jpg" alt="Imagen 2"></div>
            <div><img src="../img/oferta7.jpg" alt="Imagen 3"></div>
            <div><img src="../img/oferta4.jpg" alt="Imagen 4"></div>
            <div><img src="../img/oferta6.jpg" alt="Imagen 5"></div>
        </div>
        <!-- Controles del carrusel -->
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    
    <h2>TENEMOS TODO LO QUE NECESITAS</h2>
    <table>
        <tr>
            <td>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/frutas.png" alt="Frutas y Verduras">
                    <br>
                    Frutas y Verduras
                </a><br>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/Alimentos.png" alt="Alimentos">
                    <br>
                    Alimentos
                </a>
            </td>
            <td>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/Snack 2.png" alt="Snacks">
                    <br>
                    Snacks
                </a><br>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/Vida sana 2.png" alt="Vida Sana">
                    <br>
                    Vida Sana
                </a>
            </td>
            <td>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/congelados.png" alt="Helados">
                    <br>
                    Helados
                </a><br>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/Panificados 2.png" alt="Pizzas y Empanadas">
                    <br>
                    Pizzas y Empanadas
                </a>
            </td>
            <td>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/Cosmetica 2.png" alt="Maquillaje">
                    <br>
                    Maquillaje
                </a><br>
                <a href="#" class="tabla-imagenes">
                    <img src="../img/confiteria.png" alt="Cuidado de la Piel">
                    <br>
                    Cuidado de la Piel
                </a>
            </td>
        </tr>
    </table>
    <!-- Scripts de Bootstrap -->
    <!-- Scripts de Slick Carousel -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.slick-carousel').slick({
                autoplay: true,
                autoplaySpeed: 1500, // Velocidad de reproducción automática en milisegundos
                dots: true, // Muestra los puntos de navegación
                arrows: true, // Muestra las flechas de navegación
                infinite: true, // Bucle infinito
                speed: 500 // Velocidad de transición en milisegundos
            });
        });
    </script>    
</body>

<footer>
    <div class="container">
        <div class="row">
        <div class="col-md-4">
            <h3>MICRO GUSTITCO</h3>
            <ul>
            <li><a href="#">Trabaje con Nosotros</a></li>
            <li><a href="#">Facturación Electrónica</a></li>
            <li><a href="#">Derechos sobre datos personales</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h3>LA EMPRESA</h3>
            <ul>
            <li><a href="#">Acerca de Supermaxi</a></li>
            <li><a href="#">Responsabilidad Social</a></li>
            <li><a href="#">Convenio de afiliación</a></li>
            </ul>
        </div>
        <div class="col-md-4">
            <h3>INFORMACIÓN DE INTERÉS</h3>
            <ul>
            <li><a href="#">Términos y Condiciones</a></li>
            <li><a href="#">Políticas de privacidad</a></li>
            <li><a href="#">Preguntas Frecuentes</a></li>
            </ul>
        </div>
        </div>
        <hr>
        <div class="row">
        <div class="col-md-12">
            <p class="text-center">Copyright &copy; 2024 - MICRO GUSTITCO</p>
        </div>
        </div>
    </div>
</footer>



</html>
