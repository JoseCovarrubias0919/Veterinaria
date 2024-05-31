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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <link rel="stylesheet" type="text/css" href="Index.css">
  <link rel="icon" href="Imagenes/logo.jpg">
</head>
<body>
<header>"Apóyanos con tu donativo"</header>
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
</body>
</html>
