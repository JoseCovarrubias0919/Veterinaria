<?php
//Llamada a otros archivos
$direccion = dirname(dirname(__FILE__));
require_once($direccion . '\Modelo\Usuario.php');
/*require_once($direccion . '\Vista\Consulta_M.php');
require_once($direccion . '\Vista\Eliminar_M.php');
require_once($direccion . '\Vista\Modificar_M.php');*/

class UsuarioControl {
	
	//Acciones
	public function verificarUsuario ($valorUsuario, $valorContraseña) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Login.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$user = new Usuario();
		$user->setUsuario($valorUsuario);
		$user->setContraseña($valorContraseña);
		$usuario = $user->getUsuario();
		$contraseña = $user->getContraseña;
		
		//Query
		$sql = "SELECT Permiso, Nombre FROM usuario WHERE Usuario = '$valorUsuario' AND Contraseña = '$valorContraseña'";
		$result = $conn->query($sql);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
}
?>