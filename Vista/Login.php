<?php
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$direccion = dirname(dirname(__FILE__));
	require_once($direccion.'\Controlador\Controlador_U.php');
	$control = new UsuarioControl();
	// Obtener los valores del formulario de inicio de sesión
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = $control->verificarUsuario($username, $password);
	echo $result->num_rows;

	// Verificar si se encontró un registro coincidente
	if ($result->num_rows == 1) {
		// Obtener el valor del campo 'permiso'
    	$row = $result->fetch_assoc();
    	$permiso = $row['Permiso'];
		$nombreE = $row['Nombre'];
    	// Usuario y contraseña válidos, redirigir al panel principal
    	header("Location: Style.php?permiso=$permiso&nombreE=$nombreE");
    	exit();
	} else {
    	// Usuario o contraseña incorrectos
    	$error = "Usuario o contraseña incorrectos";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="Login.css">
  <link rel="icon" href="Imagenes/logo.jpg">
</head>
<body>
<div class="barra"></div>
  <div class="login-container">
    <h2>Iniciar sesión</h2>
    <?php if (isset($error)) { ?>
      <p class="error-message"><?php echo $error; ?></p>
    <?php } ?>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Nombre de usuario" required><br>
      <input type="password" name="password" placeholder="Contraseña" required><br>
      <button type="submit">Iniciar sesión</button>
    </form>
  </div>
</body>
</html>
