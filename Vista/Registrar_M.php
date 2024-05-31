<?php
error_reporting(0);
$permiso = $_GET['permiso']; // Obtén el permiso desde tu lógica de autenticación
$nombreE = $_GET['nombreE'];

// Verifica si el permiso es "User"
if ($permiso == "User") {
    $ocultarInsumos = "style='display: none;'"; // Oculta los botones de insumos
    $ocultarMonetario = "style='display: none;'"; // Oculta los botones de monetario
} else {
    $ocultarInsumos = ""; // No oculta los botones de insumos
    $ocultarMonetario = ""; // No oculta los botones de monetario
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $direccion = dirname(dirname(__FILE__));
    require_once($direccion . '\Controlador\Controlador_M.php');
    $control = new MonetarioControl();
	$confirmacion = $_POST['confirmacion'];
    $nombre = $_POST['nombre'];
    if ($nombre == "") {
        $nombre = $_POST['nombre2'];
    }
    $fecha = $_POST['fecha'];
    $cantidad = intval($_POST['cantidad']);

    // Validación de campos
    $nombreValido = preg_match('/^[A-Za-z ]*$/', $nombre);
    $cantidadValida = preg_match('/^[0-9]+$/', $cantidad);
    $fechaValida = strtotime($fecha) <= strtotime(date("Y-m-d")); // Verificar que la fecha no sea mayor al día de hoy

    if (!$nombreValido && !$cantidadValida) {
        echo '<script>alert("Error: El campo \'Nombre\' solo acepta letras y el campo \'Cantidad\' solo acepta números.");</script>';
        exit();
    } elseif (!$nombreValido) {
        echo '<script>alert("Error: El campo \'Nombre\' solo acepta letras.");</script>';
        exit();
    } elseif (!$cantidadValida) {
        echo '<script>alert("Error: El campo \'Cantidad\' solo acepta números.");</script>';
        exit();
    } elseif (!$fechaValida) {
        echo '<script>alert("Error: La fecha de la donación no puede ser mayor a la fecha actual.");</script>';
        exit();
    }

    if ($confirmacion == "true") {
    	$control->registrarMonetario($nombre, $cantidad, $fecha);

    	header("Location: Imprimir_Ticket.php?nombre=$nombre&cantidad=$cantidad&permiso=$permiso&nombreE=$nombreE");
	} else {
    	// Limpiar el formulario después de enviarlo
    	echo "<script>";
    	echo "document.getElementById('nombre').value = '';";
    	echo "document.getElementById('cantidadOtroRadio').checked = false;";
    	echo "document.getElementById('fecha').value = '';";
    	echo "</script>";
	}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registrar Donacion</title>
    <link rel="stylesheet" type="text/css" href="Style_RM.css">
    <link rel="icon" href="Imagenes/logo.jpg">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleAnonimo() {
            var nombreInput = document.getElementById('nombre');
            var anonimoBtn = document.getElementById('anonimoBtn');

            if (anonimoBtn.checked) {
                nombreInput.value = 'Anonimo';
                nombreInput.setAttribute('readonly', 'readonly');
                nombreInput.setAttribute('disabled', 'disabled');
                nombreInput.setAttribute('value', 'Anonimo');
            } else {
                nombreInput.removeAttribute('readonly');
                nombreInput.removeAttribute('disabled');
                nombreInput.value = '';
            }
        }
		
		function confirmarRegistro() {
        var nombre = document.getElementById('nombre').value;
            var cantidad = 0;
            var radios = document.getElementsByName('cantidad');
            var cantidadOtroRadio = document.getElementById('cantidadOtroRadio');
            var fecha = document.getElementById('fecha').value;

            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    cantidad = radios[i].value;
                    break;
                }
            }

            var mensaje = "¿Estás seguro de que estos son los datos correctos?\n\n" +
                "Nombre: " + nombre + "\n" +
                "Cantidad: $" + cantidad + "\n" +
                "Fecha: " + fecha;

            var confirmacion = confirm(mensaje);

            if (confirmacion) {
				document.getElementById('confirmacion').value = 'true';
                return true; // Permite el envío del formulario
            } else {
				document.getElementById('confirmacion').value = 'false';
                return false; // Evita el envío del formulario
            }
    }
    </script>
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
                                <li <?php echo $ocultarMonetario; ?>><a href="<?php echo "http://localhost/proyecto/Vista/Consulta_M.php?permiso=$permiso&nombreE=$nombreE"; ?>">Consultar</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Insumos</a>
                            <ul>
                                <li><a href="<?php echo "http://localhost/proyecto/Vista/Registrar_I.php?permiso=$permiso&nombreE=$nombreE"; ?>">Registrar</a></li>
                                <li <?php echo $ocultarInsumos; ?>><a href="<?php echo "http://localhost/proyecto/Vista/Consultar_I.php?permiso=$permiso&nombreE=$nombreE"; ?>">Consultar</a></li>
                            </ul>
                        </li>
                        <li><a href="http://localhost/proyecto/Vista/Login.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class="titulo">
    <h1>Registrar Donacion</h1>
    </div>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return confirmarRegistro()">
            
            <div class="check-box">
            <label for="anonimoBtn">Anónimo</label>
            <input type="checkbox" id="anonimoBtn" onclick="toggleAnonimo()">
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                <input type="hidden" name="nombre2" value="Anonimo">
            </div>
            
            <div class="form-group">
                <label for="fecha">Fecha:</label>
				<input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>
            </div>
            
            <div class="radio-buttons">
                <label for="cantidad">Cantidad:</label>
                <div class="radio-button">
                    <input type="radio" name="cantidad" id="cantidad" value="50" required>
                	<label for="cantidad50">$50</label>
                </div>
                <div class="radio-button">
                    <input type="radio" id="cantidad" name="cantidad" value="100" required>
                    <label for="cantidad1">$100</label>
                </div>
                <div class="radio-button">
                    <input type="radio" id="cantidad" name="cantidad" value="200" required>
                    <label for="cantidad2">$200</label>
                </div>
                <div class="radio-button">
                    <input type="radio" id="cantidad" name="cantidad" value="500" required>
                    <label for="cantidad3">$500</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="cantidad" id="cantidad" value="1000" required>
                	<label for="cantidad1000">$1000</label>
                </div>
            </div>

            <input type="hidden" id="confirmacion" name="confirmacion" value="">
            
            <div class="form-group">
                <input type="submit" value="Registrar">
            </div>
        </form>
    </div>
</body>

</html>
