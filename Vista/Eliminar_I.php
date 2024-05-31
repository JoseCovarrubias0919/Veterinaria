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
  $id = $_POST['id'];
  $control->eliminarInsumo($id);
header('Location: Consultar_I.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Insumos</title>
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
	                break;
	            case "medicamento":
	                alimentos.style.display = "none";
	                medicamentos.style.display = "block";
	                objetos.style.display = "none";
					comestibles.style.display = "block";
	                break;
	            case "objeto":
	                alimentos.style.display = "none";
	                medicamentos.style.display = "none";
	                objetos.style.display = "block";
					comestibles.style.display = "none";
	                break;
	            default:
	                alimentos.style.display = "none";
	                medicamentos.style.display = "none";
	                objetos.style.display = "none";
					comestibles.style.display = "block";
	                break;
	        }
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
	<h1>Eliminar Insumos</h1>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="tipo-insumo">Tipo de Insumo:</label>
    <label><?php echo $tipo_insumo; ?></label>

    <label for="nombre">Id:</label>
    <label><?php echo $id; ?></label>
        
    <label for="nombre">Nombre:</label>
    <label><?php echo $nombre; ?></label>

    <label for="descripcion">Descripción:</label>
    <label><?php echo $descripcion; ?></label>

    <label for="cantidad">Cantidad:</label>
    <label><?php echo $cantidad; ?></label>
        
    <div id="comestibles">
        <label for="fecha-caducidad">Fecha de Caducidad:</label>
        <label><?php echo date('Y-m-d', strtotime($fecha_caducidad)); ?></label>

        <label for="marca">Marca:</label>
        <label><?php echo $_GET["marca"]; ?></label>
    </div>
    
    <div id="alimentos">
    <label>Selecciona el Animal:</label>
    <label><?php echo $animal; ?></label>
    </div>
    
    <div id="medicamentos">
    <label>Selecciona el Tipo de Medicamento:</label>
    <label><?php echo $tipo_medicamento; ?></label>
    </div>
        
    <div id="objetos" style="display:none">
        <label>Selecciona el Tamaño:</label>
        <label><?php echo $tamaño; ?></label>

        <label>Selecciona el Estado:</label>
        <label><?php echo $estado; ?></label>

        <label>Selecciona el Tipo de Objetos:</label>
        <label><?php echo $tipo_objeto; ?></label>
    </div>
    <div style="text-align: center;">
    	<input type="hidden" name="id" value="<?php echo $id;?>">
        <a href="Consultar_I.php" style="display: inline-block; margin-right: 10px;"><button type="button">Cancelar</button></a>
        <input type="submit" id="submit" name="submit" value="Eliminar" style="display: inline-block;">
    </div>
</form>

</body>
</html>