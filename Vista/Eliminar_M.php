<?php
error_reporting(0);
//Eliminar la transferencia de la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 	$direccion = dirname(dirname(__FILE__));
	require_once($direccion.'\Controlador\Controlador_M.php');
	$control = new MonetarioControl();
	$id = $_POST['id'];
	
	$control->eliminarMonetario($id);

  	header('Location: Consulta_M.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eliminar transferencia</title>
    <link rel="stylesheet" type="text/css" href="Eliminar_M.css">
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

	<h1>Eliminar transferencia</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<p>¿Está seguro que desea eliminar la siguiente transferencia?</p>
		<p>
			Id: <?php echo $_GET["id"];?><br>
			Nombre: <?php echo $_GET["nombre"];?><br>
			Monto: <?php echo $_GET["monto"];?><br>
			Fecha: <?php echo $_GET["fecha"];?><br>
		</p>
		<input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
		<input type="submit" value="Eliminar">
		<a href="Consulta_M.php"><input type="button" value="Cancelar"></a>
	</form>
</body>
</html>
