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
// Procesamiento del formulario
if (isset($_POST['submit'])) {
  $direccion = dirname(dirname(__FILE__));
  require_once($direccion.'\Controlador\Controlador_I.php');
  $control = new InsumoControl();
  // Recuperar datos del formulario
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $precio = $_POST['precio-unidad'];
  $cantidad = $_POST['cantidad'];
  $tipo_insumo = $_POST['tipo-insumo'];
  $tipo_medicamento = "";
  $fecha_caducidad = "";
  $marca = "";
  $animal = "";
  $tamaño = "";
  $estado = "";
  $tipo_objeto = "";
  $presentacion = "Nada";
  $observaciones = "Nada";
  
  if ($tipo_insumo == 'alimento') {
	$fecha_caducidad = $_POST['fecha-caducidad'];
  	$marca = $_POST['marca'];
 	$animal = $_POST['animal'];
    if ($_POST['respuesta'] === 'si') {
    $control->registrarInsumo($nombre, $descripcion, $precio, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $presentacion, $tipo_medicamento, $tamaño, $estado, $observaciones, $tipo_objeto);
} else {
    // Vaciar todos los campos de tipo input
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'input') !== false) {
            $_POST[$key] = '';
        }
    }
}
  } else if ($tipo_insumo == 'medicamento') {
	$fecha_caducidad = $_POST['fecha-caducidad'];
  	$marca = $_POST['marca'];
	$tipo_medicamento = $_POST['tipo-medicamento'];
	if ($tipo_medicamento === "medicina") {
		$presentacion = $_POST['presentacion'];
	}
	if ($_POST['respuesta'] === 'si') {
    $control->registrarInsumo($nombre, $descripcion, $precio, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $presentacion, $tipo_medicamento, $tamaño, $estado, $observaciones, $tipo_objeto);
} else {
    // Vaciar todos los campos de tipo input
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'input') !== false) {
            $_POST[$key] = '';
        }
    }
}
   } else if ($tipo_insumo == 'objeto') {
	$tamaño = $_POST['tamaño'];
  	$estado = $_POST['estado'];
	if ($estado == "regular") {
		$observaciones = $_POST['observaciones'];
	}
	$tipo_objeto = $_POST['tipo-objetos'];
    if ($_POST['respuesta'] === 'si') {
    $control->registrarInsumo($nombre, $descripcion, $precio, $cantidad, $tipo_insumo, $animal, $marca, $fecha_caducidad, $presentacion, $tipo_medicamento, $tamaño, $estado, $observaciones, $tipo_objeto);
} else {
    // Vaciar todos los campos de tipo input
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'input') !== false) {
            $_POST[$key] = '';
        }
    }
}
} else {
echo '<script>alert("Tipo de insumo no válido");</script>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro de Insumos</title>
    <link rel="stylesheet" type="text/css" href="Registrar_I.css">
    <link rel="icon" href="Imagenes/logo.jpg">
	<script>
    function mostrarCampos(tipoInsumo) {
    var alimentos = document.getElementById("alimentos");
    var medicamentos = document.getElementById("medicamentos");
    var objetos = document.getElementById("objetos");
    var comestibles = document.getElementById("comestibles");
    var nombreLabel = document.querySelector("label[for='nombre']");
    var fecha_cad = document.getElementById("fecha-caducidad");
    var marca = document.getElementById("marca");
    var animal = document.getElementsByName("animal");
    var tipo_med = document.getElementsByName("tipo-medicamento");
    var presentacion = document.getElementsByName("presentacion");
    var tamaño = document.getElementsByName("tamaño");
    var estado = document.getElementsByName("estado");
    var tipo_obj = document.getElementsByName("tipo-objetos");

    // Función auxiliar para establecer el atributo "required" en una lista de elementos
    function setRequired(elements, required) {
        for (var i = 0; i < elements.length; i++) {
            elements[i].required = required;
        }
    }

    switch (tipoInsumo) {
        case "alimento":
            alimentos.style.display = "block";
            setRequired(animal, true);
            medicamentos.style.display = "none";
            setRequired(tipo_med, false);
            setRequired(presentacion, false);
            objetos.style.display = "none";
            setRequired(tamaño, false);
            setRequired(estado, false);
            setRequired(tipo_obj, false);
            comestibles.style.display = "block";
            fecha_cad.required = true;
            marca.required = true;
            nombreLabel.textContent = "Nombre del Alimento";
            break;
        case "medicamento":
            alimentos.style.display = "none";
            setRequired(animal, false);
            medicamentos.style.display = "block";
            setRequired(tipo_med, true);
            setRequired(presentacion, false);
            objetos.style.display = "none";
            setRequired(tamaño, false);
            setRequired(estado, false);
            setRequired(tipo_obj, false);
            comestibles.style.display = "block";
            fecha_cad.required = true;
            marca.required = true;
            nombreLabel.textContent = "Nombre del Medicamento";
            break;
        case "objeto":
            alimentos.style.display = "none";
            setRequired(animal, false);
            medicamentos.style.display = "none";
            setRequired(tipo_med, false);
            setRequired(presentacion, false);
            objetos.style.display = "block";
            setRequired(tamaño, true);
            setRequired(estado, true);
            setRequired(tipo_obj, true);
            comestibles.style.display = "none";
            marca.required = false;
            fecha_cad.required = false;
            nombreLabel.textContent = "Nombre del Objeto";
            break;
        default:
            alimentos.style.display = "block";
            setRequired(animal, true);
            medicamentos.style.display = "none";
            setRequired(tipo_med, false);
            setRequired(presentacion, false);
            objetos.style.display = "none";
            setRequired(tamaño, false);
            setRequired(estado, false);
            setRequired(tipo_obj, false);
            comestibles.style.display = "block";
            fecha_cad.required = true;
            marca.required = true;
            nombreLabel.textContent = "Nombre del Alimento";
            break;
    }
	// Obtener los atributos según el tipo de insumo seleccionado
  var atributos = {
    tipoInsumo: tipoInsumo,
    nombre: document.getElementById("nombre").value,
    fechaCaducidad: document.getElementById("fecha-caducidad").value,
    marca: document.getElementById("marca").value,
    animal: document.querySelector('input[name="animal"]:checked').value,
    tipoMedicamento: document.querySelector('input[name="tipo-medicamento"]:checked').value,
    presentacion: document.querySelector('input[name="presentacion"]:checked').value,
    tamaño: document.querySelector('input[name="tamaño"]:checked').value,
    estado: document.querySelector('input[name="estado"]:checked').value,
    tipoObjeto: document.querySelector('input[name="tipo-objetos"]:checked').value
  };

  // Almacenar los atributos en un campo de entrada oculto
  var atributosInput = document.getElementById("atributos");
  atributosInput.value = JSON.stringify(atributos);
}

	function mostrarAlerta() {
  var atributos = ""; // Variable para almacenar los atributos capturados

  // Recorrer los campos del formulario
  var inputs = document.querySelectorAll('input[type="text"], input[type="date"], input[type="radio"], input[type="number"], textarea');
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type !== "hidden" && inputs[i].offsetParent !== null) {
      if (inputs[i].type === "radio" && !inputs[i].checked) {
        continue; // Saltar al siguiente campo si el radio no está seleccionado
      }
      atributos += inputs[i].name + ": " + inputs[i].value + "\n";
    }
  }

  // Mostrar confirmación con los atributos capturados
  var respuesta = confirm("¿Están correctos los atributos ingresados?\n\n" + atributos);
  var respuestaInput = document.getElementById("respuesta");
  respuestaInput.value = respuesta ? "si" : "no";

  if (respuesta === false) {
    // Vaciar todos los campos de tipo input y textarea
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].value = "";
    }
  }
}



function mostrarPresentacion(checked) {
    var presentacionFieldset = document.getElementById('presentacion-medicamentos');
    var presentacionInput = document.getElementsByName('presentacion-input');

    if (checked) {
        presentacionFieldset.style.display = 'block';
        presentacionInput.required = true;
    } else {
        presentacionFieldset.style.display = 'none';
        presentacionInput.required = false;
    }
}


	
	function mostrarObservaciones(checked) {
    var observacionesFieldset = document.getElementById('observaciones');
    var observacionesInput = document.getElementById('observaciones-input');

    if (checked) {
        observacionesFieldset.style.display = 'block';
        observacionesInput.required = true;
    } else {
        observacionesFieldset.style.display = 'none';
        observacionesInput.required = false;
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
    <h1>Registro de Insumos</h1>
    </div>

	<form action="" method="POST" onsubmit="mostrarAlerta()">
    <label for="tipo-insumo">Tipo de Insumo:</label>
    <select name="tipo-insumo" id="tipo-insumo" onchange="mostrarCampos(this.value)">
        <option value="alimento">Alimento</option>
        <option value="medicamento">Medicamento</option>
        <option value="objeto">Objetos</option>
    </select>

    <label for="nombre" id="nombre-label">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="[^0-9]*" title="No se permiten valores numéricos" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" min="0" required>
    
    <label for="precio-unidad">Precio por Unidad:</label>
	<input type="number" id="precio-unidad" name="precio-unidad" min="0" step="0.01" required>

    <div id="comestibles" style="display:block">
        <label for="fecha-caducidad">Fecha de Caducidad:</label>
		<input type="date" id="fecha-caducidad" name="fecha-caducidad" required min="<?php echo date('Y-m-d'); ?>">

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required>
    </div>

    <fieldset id="alimentos" style="display:block">
        <legend>Selecciona el Animal:</legend>
        <label for="perro">
            <input type="radio" id="perro" name="animal" value="perro" required>Perro
        </label>
        <label for="gato">
            <input type="radio" id="gato" name="animal" value="gato" required>Gato
        </label>
    </fieldset>

    <div id="medicamentos" style="display:none">
        <fieldset id="tipo-medicamento">
            <legend required>Selecciona el Tipo de Medicamento:</legend>
            <label for="medicina">
                <input type="radio" id="medicina" name="tipo-medicamento" value="medicina" onclick="mostrarPresentacion(this.checked)">Medicina
            </label>
            <label for="recurso-medico">
                <input type="radio" id="recurso-medico" name="tipo-medicamento" value="recurso medico" onclick="mostrarPresentacion(false)">Recurso Medico
            </label>
        </fieldset>

        <fieldset id="presentacion-medicamentos" style="display:none">
            <legend>Presentación:</legend>
            <label for="solucion">
                <input type="radio" id="solucion" name="presentacion" value="solucion">Solución
            </label>
            <label for="pastillas">
                <input type="radio" id="pastillas" name="presentacion" value="pastillas">Pastillas
            </label>
            <label for="ampolletas">
                <input type="radio" id="ampolletas" name="presentacion" value="ampolletas">Ampolletas
            </label>
            <label for="supositorios">
                <input type="radio" id="supositorios" name="presentacion" value="supositorios">Supositorios
            </label>
        </fieldset>
    </div>

    <div id="objetos" style="display:none">
        <fieldset>
            <legend>Selecciona el Tamaño:</legend>
            <label for="grande">
                <input type="radio" id="grande" name="tamaño" value="grande">Grande
            </label>
            <label for="mediano">
                <input type="radio" id="mediano" name="tamaño" value="mediano">Mediano
            </label>
            <label for="chico">
                <input type="radio" id="chico" name="tamaño" value="chico">Chico
            </label>
        </fieldset>

        <fieldset>
            <legend>Selecciona el Estado:</legend>
            <label for="bueno">
                <input type="radio" id="bueno" name="estado" value="bueno" onclick="mostrarObservaciones(false)">Bueno
            </label>
            <label for="regular">
                <input type="radio" id="regular" name="estado" value="regular" onclick="mostrarObservaciones(this.checked)">Regular
            </label>
        </fieldset>

        <fieldset id="observaciones" style="display:none">
            <legend>Observaciones:</legend>
            <textarea id="observaciones-input" name="observaciones"></textarea>
        </fieldset>

        <fieldset>
            <legend>Selecciona el Tipo de Objetos:</legend>
            <label for="accesorio">
                <input type="radio" id="accesorio" name="tipo-objetos" value="accesorio">Accesorio
            </label>
            <label for="juguete">
                <input type="radio" id="juguete" name="tipo-objetos" value="juguete">Juguete
            </label>
            <label for="camas">
                <input type="radio" id="camas" name="tipo-objetos" value="camas">Camas
            </label>
            <label for="otros">
                <input type="radio" id="otros" name="tipo-objetos" value="otros">Otros
            </label>
        </fieldset>
    </div>

    <input type="hidden" id="atributos" name="atributos">
    <input type="hidden" id="respuesta" name="respuesta">
    <input type="submit" id="submit" name="submit" value="Registrar">
</form>



</body>
</html>