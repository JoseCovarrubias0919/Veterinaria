<?php
        error_reporting(0);
		$permiso = $_GET['permiso']; // Obtén el permiso desde tu lógica de autenticación
		$nombreE = $_GET['nombreE'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de transacciones</title>
    <link rel="stylesheet" type="text/css" href="Consulta_M.css">
    <link rel="icon" href="Imagenes/logo.jpg">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="barra">
        <a href="<?php echo "Style.php?permiso=$permiso&nombreE=$nombreE" ?>">
            <div class="logo">
                <img src="Imagenes/logo.jpg">
            </div>
        </a>
        <nav>
            <ul id="menu">
                <li><a href="#">Donar</a>
                    <ul>
                        <li><a href="#">Monetaria</a>
                            <ul>
                                <li><a href="<?php echo "http://localhost/proyecto/Vista/Registrar_M.php?permiso=$permiso&nombreE=$nombreE"; ?>">Registrar</a></li>
                                <li><a href="<?php echo "http://localhost/proyecto/Vista/Consulta_M.php?permiso=$permiso&nombreE=$nombreE"; ?>">Consultar</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Insumos</a>
                            <ul>
                                <li><a href="<?php echo "http://localhost/proyecto/Vista/Registrar_I.php?permiso=$permiso&nombreE=$nombreE"; ?>">Registrar</a></li>
                                <li><a href="<?php echo "http://localhost/proyecto/Vista/Consultar_I.php?permiso=$permiso&nombreE=$nombreE"; ?>">Consultar</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/proyecto/Vista/Login.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="titulo">
    <h1>Búsqueda de transacciones</h1>
    </div>
    <div class="container">
        <form method="post" action="">
            <label for="fecha">Fecha:</label>
            <input type="month" id="fecha" name="fecha">
            <label for="monto">Monto:</label>
            <input type="text" id="monto" name="monto">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <div id="resultados">
        <?php
        error_reporting(0);
		$permiso = $_GET['permiso']; // Obtén el permiso desde tu lógica de autenticación
		$nombreE = $_GET['nombreE'];
        $direccion = dirname(dirname(__FILE__));
        require_once($direccion.'\Controlador\Controlador_M.php');
        $control = new MonetarioControl();

        // Comprobar si se ha enviado la búsqueda
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Obtener los valores de la búsqueda
            $fecha = $_POST["fecha"];
            $monto = $_POST["monto"];

            // Comprobar si hay valores de fecha y monto
            if (empty($fecha) && empty($monto)) {
                echo '<script>alert("No se han ingresado valores para buscar");</script>';
            } else {

                $result = $control->consultarMonetario($monto, $fecha);

                // Colorar los resultados en una variable
                if ($result->num_rows > 0) {
                    $resultados_html = "<table>";
                    $resultados_html .= "<thead><tr><th>ID</th><th>Nombre</th><th>Fecha</th><th>Monto</th></tr></thead>";
                    $resultados_html .= "<tbody>";
                    while ($row = $result->fetch_assoc()) {

                        $id = $row["IdMonetaria"];
                        $nombre = $row["Nombre"];
                        $fecha = $row["Fecha"];
                        $monto = $row["Monto"];
						$total = $total + $monto;

                        $resultados_html .= "<tr><td>" . $id . "</td><td>" . $nombre . "</td><td>" . $fecha . "</td><td>" . $monto . "</td>";
                    }
                    $resultados_html .= "</tbody>";
                    $resultados_html .= "</table>";
					$resultados_html .= "<h2>Total del la busqueda: $total</h2>";
                } else {
                    $resultados_html = '<script>alert("No se encontraron resultados");</script>';
                }

                // Mostrar los resultados en el div con id "resultados"
                echo $resultados_html;
                ?>
                <form method="post" action="<?php echo "Imprimir_EC.php?permiso=$permiso&nombreUsuario=$nombreE"; ?>">
                    <input type="hidden" name="tabla" value="<?php echo htmlentities($resultados_html); ?>">
                    <input type="hidden" name="nombreUsuario" value="<?php echo htmlentities($nombreUsuario); ?>">
                    <input type="submit" value="Imprimir">
                </form>
                <?php

                // Liberar los recursos de la consulta
                $result->free_result();
            }
        }
        ?>
    </div>
</body>
</html>
