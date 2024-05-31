<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Imagenes/logo.jpg">
    <title>Impresión de resultados</title>
    <style>
        body {
            background-image: url("Imagenes/Perros Vectores Libres de Derechos.jpg");
			font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
			background-color:#FFF;
			display: inline-block;
  			padding: 10px;
  			margin-left: auto;
  			margin-right: auto;
        }
		p {
            color: #333;
			background-color:#FFF;
			display: inline-block;
  			padding: 10px;
  			margin-left: auto;
  			margin-right: auto;
        }
		h2 {
            color: #333;
			background-color:#FFF;
			display: inline-block;
  			padding: 10px;
  			margin-left: auto;
  			margin-right: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
			background-color:#FFF;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .button-container {
            margin-top: 20px;
            text-align: center;
        }
        .button-container a {
            display: inline-block;
            background-color: #3b5998;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin-right: 10px;
        }
        @media print {
            .button-container {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div style="text-align: center; display: grid;">
    <h1>Ingresos de Cuenta</h1>
    
    <?php
	error_reporting(0);
    // Obtener la tabla generada y el nombre de usuario
	$permiso = $_GET['permiso'];
    $tabla = $_POST["tabla"];
    $nombreUsuario = $_GET["nombreUsuario"];

    // Mostrar la tabla generada y el nombre de usuario
	echo "<p>Nombre de usuario: $nombreUsuario</p>";
    echo "<h2>Tabla generada:</h2>";
    echo $tabla;
    ?>
    </div>

    <div class="button-container">
        <a href="#" onclick="window.print()">Imprimir ventana</a>
        <a href="<?php echo "http://localhost/proyecto/Vista/Consulta_M.php?permiso=$permiso&nombreE=$nombreUsuario" ?>">Regresar</a>
    </div>
</body>
</html>
