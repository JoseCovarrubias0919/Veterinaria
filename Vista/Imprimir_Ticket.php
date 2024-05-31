<?php
error_reporting(0);
$permiso = $_GET['permiso'];
$nombreE = $_GET['nombreE'];
$nombreDonante = $_GET['nombre'];
$fecha = date("Y-m-d");
$montoDonacion = $_GET['cantidad'];
$agradecimiento = "Gracias por su generosa donación.";
$fundacion = "Fundación GYPSU";
$consensuada = "Esta donación fue consensuada por el donante.";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Imagenes/logo.jpg">
    <title>Ticket de Donación</title>
    <style>
        body {
            background-image: url("Imagenes/Perros Vectores Libres de Derechos.jpg");
			font-family: Arial, sans-serif;
            color: black;
        }

        h2 {
            color: black;
            text-align: center;
			background-color:#FFF;
			display: inline-block;
  			padding: 10px;
  			margin-left: auto;
  			margin-right: auto;
        }

        p {
            color: black;
            margin-bottom: 10px;
            text-align: center;
			background-color:#FFF;
			display: inline-block;
  			padding: 10px;
  			margin-left: auto;
  			margin-right: auto;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        @media print {
            .button-container {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div style="text-align: center; display: grid;">
    <h2>Ticket de Donación</h2>
    <p><strong>Fecha:</strong> <?php echo $fecha; ?></p>
    <p><strong>Donante:</strong> <?php echo $nombreDonante; ?></p>
    <p><strong>Monto:</strong> <?php echo $montoDonacion; ?></p>
    <p><?php echo $agradecimiento; ?></p>
    <p>Respaldado por <?php echo $fundacion; ?></p>
    <p><?php echo $consensuada; ?></p>
    </div>

    <div class="button-container">
        <button onclick="window.location.href = '<?php echo "http://localhost/proyecto/Vista/Registrar_M.php?permiso=$permiso&nombreE=$nombreE" ?>';">Regresar</button>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
