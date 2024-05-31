<?php
error_reporting(0);
$id = $_GET["id"];
$nombre = $_GET["nombre"];
$descripcion = $_GET["descripcion"];
$cantidad = intval($_GET["cantidad"]);
$tipo_insumo = $_GET["tipo_insumo"];
$fecha_caducidad = "";
$animal = "";
$tipo_medicamento = "";
$tamaño = "";
$estado = "";
$tipo_objeto = "";
if ($tipo_insumo == 'alimento') {
	$fecha_caducidad = $_GET["fecha_cad"];
  	$marca = $_GET["marca"];
 	$animal = $_GET["animal"];
  } else if ($tipo_insumo == 'medicamento') {
	$fecha_caducidad = $_GET["fecha_cad"];
  	$marca = $_GET["marca"];
	$tipo_medicamento = $_GET["tipo_med"];
   } else if ($tipo_insumo == 'objeto') {
	$tamaño = $_GET["tamaño"];
  	$estado = $_GET["estado"];
	$tipo_objeto = $_GET["tipo_objeto"];
}
// Procesamiento del formulario
if (isset($_POST['submit'])) {
  $direccion = dirname(dirname(__FILE__));
  require_once($direccion.'\Controlador\Controlador_I.php');
  $control = new InsumoControl();
  // Recuperar datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $cantidad = $_POST['cantidad'];
  $tipo_insumo = $_POST['tipo-insumo2'];
  $id = $_POST['id'];
  $tipo_medicamento = "";
  $fecha_caducidad = "";
  $marca = "";
  $animal = "";
  $tamaño = "";
  $estado = "";
  $tipo_objeto = "";
  
  if ($tipo_insumo == 'alimento') {
	$fecha_caducidad = $_POST['fecha-caducidad'];
  	$marca = $_POST['marca'];
 	$animal = $_POST['animal'];
    $control->modificarInsumo($id, $nombre, $descripcion, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $tipo_medicamento, $tamaño, $estado, $tipo_objeto);
  } else if ($tipo_insumo == 'medicamento') {
	$fecha_caducidad = $_POST['fecha-caducidad'];
  	$marca = $_POST['marca'];
	$tipo_medicamento = $_POST['tipo-medicamento'];
    $control->modificarInsumo($id, $nombre, $descripcion, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $tipo_medicamento, $tamaño, $estado, $tipo_objeto);
   } else if ($tipo_insumo == 'objeto') {
	$tamaño = $_POST['tamaño'];
  	$estado = $_POST['estado'];
	$tipo_objeto = $_POST['tipo-objetos'];
    $control->modificarInsumo($id, $nombre, $descripcion, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $tipo_medicamento, $tamaño, $estado, $tipo_objeto);
} else {
echo '<script>alert("Tipo de insumo no válido");</script>';
}
header('Location: Consultar_I.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Insumos</title>
    <link rel="stylesheet" type="text/css" href="Registrar_I.css">
    <link rel="icon" href="Imagenes/logo.jpg">
	<script>
	    function mostrarCampos(tipoInsumo) {
        var alimentos = document.getElementById("alimentos");
        var medicamentos = document.getElementById("medicamentos");
        var objetos = document.getElementById("objetos");
        var comestibles = document.getElementById("comestibles");

        switch (tipoInsumo) {
            case "alimento":
                alimentos.style.display = "block";
                medicamentos.style.display = "none";
                objetos.style.display = "none";
                comestibles.style.display = "block";
                actualizarCamposRequeridos(true);
                break;
            case "medicamento":
                alimentos.style.display = "none";
                medicamentos.style.display = "block";
                objetos.style.display = "none";
                comestibles.style.display = "block";
                actualizarCamposRequeridos(true);
                break;
            case "objeto":
                alimentos.style.display = "none";
                medicamentos.style.display = "none";
                objetos.style.display = "block";
                comestibles.style.display = "none";
                actualizarCamposRequeridos(true);
                break;
            default:
                alimentos.style.display = "none";
                medicamentos.style.display = "none";
                objetos.style.display = "none";
                comestibles.style.display = "block";
                actualizarCamposRequeridos(false);
                break;
        }
    }

    function actualizarCamposRequeridos(requeridos) {
        var campos = document.querySelectorAll("#nombre, #descripcion, #cantidad");

        campos.forEach(function (campo) {
            if (requeridos) {
                campo.setAttribute("required", "");
            } else {
                campo.removeAttribute("required");
            }
        });
    }
	    
	    window.onload = function() {
	        mostrarCampos("<?php echo $tipo_insumo; ?>");
	    };
	</script>
</head>
<body>
<div class="barra">
	<div class="logo">
		<img src="Imagenes/logo.jpg">
	</div>
	<nav>
    <ul id="menu">
      <li><a href="#">Donar</a>
        <ul>
          <li><a href="#">Monetaria</a>
            <ul>
              <li><a href="http://localhost/proyecto/Vista/Registrar_M.php">Registrar</a></li>
              <li><a href="http://localhost/proyecto/Vista/Consulta_M.php">Consultar</a></li>
              <li><a href="http://localhost/proyecto/Vista/Consulta_M.php">Modificar</a></li>
              <li><a href="http://localhost/proyecto/Vista/Consulta_M.php">Eliminar</a></li>
            </ul>
          </li>
          <li><a href="#">Insumos</a>
            <ul>
              <li><a href="http://localhost/proyecto/Vista/Registrar_I.php">Registrar</a></li>
              <li><a href="http://localhost/proyecto/Vista/Consultar_I.php">Consultar</a></li>
              <li><a href="#">Modificar</a></li>
              <li><a href="#">Eliminar</a></li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>
	<h1>Modificar Insumos</h1>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <input type="hidden" name="tipo-insumo2" value="<?php echo $tipo_insumo;?>">
    <label for="tipo-insumo">Tipo de Insumo:</label>
    <select name="tipo-insumo" id="tipo-insumo" onchange="mostrarCampos(this.value)" disabled>
        <option value="alimento" <?php if ($tipo_insumo === 'alimento') echo 'selected'; ?>>Alimento</option>
        <option value="medicamento" <?php if ($tipo_insumo === 'medicamento') echo 'selected'; ?>>Medicamento</option>
        <option value="objeto" <?php if ($tipo_insumo === 'objeto') echo 'selected'; ?>>Objetos</option>
    </select>

    <label for="nombre">Id:</label>
    <input type="text" id="id" name="id" value="<?php echo $id;?>" readonly>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="[^0-9]*" title="No se permiten valores numéricos" value="<?php echo $nombre;?>" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo $descripcion;?></textarea>

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" min="0" value="<?php echo $cantidad;?>" required>

    <div id="comestibles">
        <label for="fecha-caducidad">Fecha de Caducidad:</label>
        <input type="date" id="fecha-caducidad" name="fecha-caducidad" value="<?php echo date('Y-m-d', strtotime($fecha_caducidad));?>" required>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?php echo $_GET["marca"];?>" required>
    </div>

    <fieldset id="alimentos" style="display:block">
        <legend>Selecciona el Animal:</legend>
        <label for="perro">
            <input type="radio" id="perro" name="animal" value="perro" <?php if ($animal === 'perro') echo 'checked'; ?> required>Perro
        </label>
        <label for="gato">
            <input type="radio" id="gato" name="animal" value="gato" <?php if ($animal === 'gato') echo 'checked'; ?>>Gato
        </label>
    </fieldset>

    <fieldset id="medicamentos" style="display:none">
        <legend>Selecciona el Tipo de Medicamento:</legend>
        <label for="medicina">
            <input type="radio" id="medicina" name="tipo-medicamento" value="medicina" <?php if ($tipo_medicamento === 'medicina') echo 'checked'; ?> required>Medicina
        </label>
        <label for="recurso-medico">
            <input type="radio" id="recurso-medico" name="tipo-medicamento" value="recurso medico" <?php if ($tipo_medicamento === 'recurso medico') echo 'checked'; ?>>Recurso Medico
        </label>
    </fieldset>

    <div id="objetos" style="display:none">
        <fieldset>
            <legend>Selecciona el Tamaño:</legend>
            <label for="grande">
                <input type="radio" id="grande" name="tamaño" value="grande" <?php if ($tamaño === 'grande') echo 'checked'; ?> required>Grande
            </label>
            <label for="mediano">
                <input type="radio" id="mediano" name="tamaño" value="mediano" <?php if ($tamaño === 'mediano') echo 'checked'; ?>>Mediano
            </label>
            <label for="chico">
                <input type="radio" id="chico" name="tamaño" value="chico" <?php if ($tamaño === 'chico') echo 'checked'; ?>>Chico
            </label>
        </fieldset>

        <fieldset>
            <legend>Selecciona el Estado:</legend>
            <label for="bueno">
                <input type="radio" id="bueno" name="estado" value="bueno" <?php if ($estado === 'bueno') echo 'checked'; ?> required>Bueno
            </label>
            <label for="regular">
                <input type="radio" id="regular" name="estado" value="regular" <?php if ($estado === 'regular') echo 'checked'; ?>>Regular
            </label>
            <label for="malo">
                <input type="radio" id="malo" name="estado" value="malo" <?php if ($estado === 'malo') echo 'checked'; ?>>Malo
            </label>
        </fieldset>

        <fieldset>
            <legend>Selecciona el Tipo de Objetos:</legend>
            <label for="accesorio">
                <input type="radio" id="accesorio" name="tipo-objetos" value="accesorio" <?php if ($tipo_objeto === 'accesorio') echo 'checked'; ?> required>Accesorio
            </label>
            <label for="juguete">
                <input type="radio" id="juguete" name="tipo-objetos" value="juguete" <?php if ($tipo_objeto === 'juguete') echo 'checked'; ?>>Juguete
            </label>
            <label for="camas">
                <input type="radio" id="camas" name="tipo-objetos" value="camas" <?php if ($tipo_objeto === 'camas') echo 'checked'; ?>>Camas
            </label>
            <label for="otros">
                <input type="radio" id="otros" name="tipo-objetos" value="otros" <?php if ($tipo_objeto === 'otros') echo 'checked'; ?>>Otros
            </label>
        </fieldset>
    </div>

    <input type="submit" id="submit" name="submit" value="Modificar">
</form>


</body>
</html>