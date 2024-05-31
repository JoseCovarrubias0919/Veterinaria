<?php
        error_reporting(0);
		$permiso = $_GET['permiso']; // Obtén el permiso desde tu lógica de autenticación
		$nombreE = $_GET['nombreE'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consulta de Insumos</title>
    <link rel="stylesheet" type="text/css" href="Consultar_I.css">
    <link rel="icon" href="Imagenes/logo.jpg">
    <script>
	    function mostrarCampos(tipoInsumo) {
    var alimentos = document.getElementById("alimentos");
    var medicamentos = document.getElementById("medicamentos");
    var objetos = document.getElementById("objetos");
    var comestibles = document.getElementById("comestibles");
    var nombreLabel = document.querySelector("label[for='nombre']");

    // Función auxiliar para establecer el atributo "required" en una lista de elementos
    function setRequired(elements, required) {
        for (var i = 0; i < elements.length; i++) {
            elements[i].required = required;
        }
    }

    switch (tipoInsumo) {
        case "alimento":
            alimentos.style.display = "block";
            medicamentos.style.display = "none";
            objetos.style.display = "none";
            comestibles.style.display = "block";
            nombreLabel.textContent = "Nombre del Alimento";
            break;
        case "medicamento":
            alimentos.style.display = "none";
            medicamentos.style.display = "block";
            objetos.style.display = "none";
            comestibles.style.display = "block";
            nombreLabel.textContent = "Nombre del Medicamento";
            break;
        case "objeto":
            alimentos.style.display = "none";
            medicamentos.style.display = "none";
            objetos.style.display = "block";
            comestibles.style.display = "none";
            nombreLabel.textContent = "Nombre del Objeto";
            break;
        default:
            alimentos.style.display = "none";
            medicamentos.style.display = "none";
            objetos.style.display = "none";
            comestibles.style.display = "block";
            nombreLabel.textContent = "Nombre";
            break;
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
    <h1>Consulta de Insumos</h1>
    </div>

	<form action="" method="POST">
    <label for="tipo-insumo">Tipo de Insumo:</label>
    <select name="tipo-insumo" id="tipo-insumo" onchange="mostrarCampos(this.value)">
        <option value="alimento">Alimento</option>
        <option value="medicamento">Medicamento</option>
        <option value="objeto">Objetos</option>
    </select>

    <label for="nombre" id="nombre-label">Nombre:</label>
    <input type="text" id="nombre" name="nombre" pattern="[^0-9]*" title="No se permiten valores numéricos">

    <label for="cantidad">Cantidad:</label>
    <input type="number" id="cantidad" name="cantidad" min="0">
    
    <label for="precio-unidad">Precio por Unidad:</label>
	<input type="number" id="precio-unidad" name="precio-unidad" min="0" step="0.01">

    <div id="comestibles" style="display:block">
        <label for="fecha-caducidad">Fecha de Caducidad:</label>
		<input type="month" id="fecha-caducidad" name="fecha-caducidad">

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca">
    </div>

    <fieldset id="alimentos" style="display:block">
        <legend>Selecciona el Animal:</legend>
        <label for="perro">
            <input type="radio" id="perro" name="animal" value="perro">Perro
        </label>
        <label for="gato">
            <input type="radio" id="gato" name="animal" value="gato">Gato
        </label>
    </fieldset>

    <div id="medicamentos" style="display:none">
        <fieldset id="tipo-medicamento">
            <legend required>Selecciona el Tipo de Medicamento:</legend>
            <label for="medicina">
                <input type="radio" id="medicina" name="tipo-medicamento" value="medicina">Medicina
            </label>
            <label for="recurso-medico">
                <input type="radio" id="recurso-medico" name="tipo-medicamento" value="recurso medico">Recurso Medico
            </label>
        </fieldset>

        <fieldset id="presentacion-medicamentos">
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
            <legend>Selecciona el Estado:</legend>
            <label for="bueno">
                <input type="radio" id="bueno" name="estado" value="bueno">Bueno
            </label>
            <label for="regular">
                <input type="radio" id="regular" name="estado" value="regular">Regular
            </label>
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

    <input type="submit" id="submit" name="submit" value="Buscar">
</form>

	<?php
    error_reporting(0);
    $permiso = $_GET['permiso']; // Obtén el permiso desde tu lógica de autenticación
    $nombreE = $_GET['nombreE'];
    $tabla = ""; // Variable para almacenar la tabla generada
    $mostrarBoton = false; // Variable para determinar si mostrar el botón de imprimir

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $direccion = dirname(dirname(__FILE__));
        require_once($direccion.'\Controlador\Controlador_I.php');
        $control = new InsumoControl();

        $tipo_insumo = $_POST["tipo-insumo"];
        $nombre = $_POST["nombre"];
        $precio = $_POST['precio-unidad'];
        $cantidad = $_POST["cantidad"];
        $marca = $_POST["marca"];
        $fecha_caducidad = $_POST['fecha-caducidad'];

        $result = $control->consultarInsumoG($nombre, $cantidad, $precio, $tipo_insumo);

        if ($result->num_rows > 0) {
            if ($tipo_insumo == "alimento") {
                $animal = $_POST['animal'];
                $tabla .= "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Tipo de Insumo</th><th>Fecha de Caducidad</th><th>Marca</th><th>Animal</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $sql2 = "SELECT * FROM alimentos WHERE IdInsumos = ".$row["IdInsumos"];
                    $result2 = $control->consultarInsumoA($animal, $marca, $fecha_caducidad, $sql2);
                    if ($result2 && $result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $tabla .= "<tr><td>".$row["IdInsumos"]."</td><td>".$row["Nombre"]."</td><td>".$row["Descripcion"]."</td><td>".$row["Cantidad"]."</td><td>".$row["Precio"]."</td><td>".$row["Tipo_Ins"]."</td><td>".$row2["Fecha_Cad"]."</td><td>".$row2["Marca"]."</td><td>".$row2["Selec_Animal"]."</td></tr>";
                    }
                }
                $tabla .= "</table>";
                $mostrarBoton = true; // Mostrar el botón de imprimir
            } else if ($tipo_insumo == "medicamento") {
                $tipo_medicamento = $_POST['tipo-medicamento'];
                $presentacion = $_POST['presentacion'];
                $tabla .= "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Tipo de Insumo</th><th>Fecha de Caducidad</th><th>Marca</th><th>Presentacion</th><th>Tipo de Medicamento</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $sql2 = "SELECT * FROM medicamentos WHERE IdInsumos = ".$row["IdInsumos"];
                    $result2 = $control->consultarInsumoM($marca, $fecha_caducidad, $presentacion, $tipo_medicamento, $sql2);
                    if ($result2 && $result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $tabla .= "<tr><td>".$row["IdInsumos"]."</td><td>".$row["Nombre"]."</td><td>".$row["Descripcion"]."</td><td>".$row["Cantidad"]."</td><td>".$row["Precio"]."</td><td>".$row["Tipo_Ins"]."</td><td>".$row2["Fecha_Cad"]."</td><td>".$row2["Marca"]."</td><td>".$row2["Presentacion"]."</td><td>".$row2["Tipo_Med"]."</td></tr>";
                    }
                }
                $tabla .= "</table>";
                $mostrarBoton = true; // Mostrar el botón de imprimir
            } else if ($tipo_insumo == "objeto") {
                $estado = $_POST['estado'];
                $tipo_objeto = $_POST['tipo-objetos'];
                $tabla .= "<table><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Tipo de Insumo</th><th>Tamaño</th><th>Estado</th><th>Observacion</th><th>Tipo de Objeto</th></tr>";
                while($row = $result->fetch_assoc()) {
                    $sql2 = "SELECT * FROM objetos WHERE IdInsumos = ".$row["IdInsumos"];
                    $result2 = $control->consultarInsumoO($estado, $tipo_objeto, $sql2);
                    if ($result2 && $result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $tabla .= "<tr><td>".$row["IdInsumos"]."</td><td>".$row["Nombre"]."</td><td>".$row["Descripcion"]."</td><td>".$row["Cantidad"]."</td><td>".$row["Precio"]."</td><td>".$row["Tipo_Ins"]."</td><td>".$row2["Tamaño"]."</td><td>".$row2["Estado"]."</td><td>".$row2["Observacion"]."</td><td>".$row2["Tipo_Objeto"]."</td></tr>";
                    }
                }
                $tabla .= "</table>";
                $mostrarBoton = true; // Mostrar el botón de imprimir
            } else {
                $tabla = "Tipo de insumo no válido";
            }
        } else {
            $tabla = "No se encontraron resultados";
        }
    }

    // Mostrar la tabla
    echo $tabla;

    // Mostrar el botón de imprimir solo si se ha realizado una búsqueda
    if ($mostrarBoton) {
?>
    <!-- Formulario y botón de imprimir -->
    <form action="<?php echo "Imprimir_RI.php?permiso=$permiso&nombreUsuario=$nombreE"; ?>" method="post">
        <input type="hidden" name="tabla" value="<?php echo htmlspecialchars($tabla); ?>">
        <input type="hidden" name="nombreE" value="<?php echo htmlspecialchars($nombreE); ?>">
        <input type="submit" value="Imprimir">
    </form>
<?php
    }
?>

</body>
</html>

