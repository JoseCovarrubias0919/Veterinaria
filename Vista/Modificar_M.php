<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modificar transferencia</title>
  <link rel="stylesheet" type="text/css" href="Modificar_M.css">
  <link rel="icon" href="Imagenes/logo.jpg">
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
  <h1>Modificar transferencia</h1>
  <div class="container">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  	<br>
    Id:</br>
    <input type="number" name="id" value="<?php echo $_GET["id"];?>" readonly>
    <br>
    Nombre:</br>
    <input type="text" name="nombre" value="<?php echo $_GET["nombre"];?>" pattern="[A-Za-z ]*">
    <br>
    Monto:</br>
    <input type="number" name="monto" value="<?php echo $_GET["monto"];?>" pattern="[0-9]+" required>
    <br>
    Fecha:</br>
    <input type="date" name="fecha" value="<?php echo $_GET["fecha"];?>" required>
    <br></br>
    <input type="submit" value="Modificar">
  </form>
  </div>
</body>
</html>

<?php
error_reporting(0);
//Procesar la información enviada por el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$direccion = dirname(dirname(__FILE__));
	require_once($direccion.'\Controlador\Controlador_M.php');
	$control = new MonetarioControl();
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$fecha = $_POST['fecha'];
	$monto = $_POST['monto'];
	
	$control->modificarMonetario($nombre, $monto, $fecha, $id);
	
  	header('Location: Consulta_M.php');
}
?>