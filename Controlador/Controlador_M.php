<?php
//Llamada a otros archivos
$direccion = dirname(dirname(__FILE__));
require_once($direccion . '\Modelo\Monetario.php');
/*require_once($direccion . '\Vista\Consulta_M.php');
require_once($direccion . '\Vista\Eliminar_M.php');
require_once($direccion . '\Vista\Modificar_M.php');*/

class MonetarioControl {
	
	//Acciones
	public function registrarMonetario ($valorNombre, $valorMonto, $valorFecha) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Registrar_M.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$monetario = new Monetario();
		$monetario->setNombre($valorNombre);
		$monetario->setMonto($valorMonto);
		$monetario->setFecha($valorFecha);
		$nombre = $monetario->getNombre();
		$fecha = $monetario->getFecha();
		$monto = $monetario->getMonto();
		
		//Query
		$sql = "INSERT INTO donacion_mon (nombre, fecha, monto) VALUES ('$nombre', '$fecha', $monto)";
		if (mysqli_query($conn, $sql)) {
  			echo '<script>alert("Donación registrada exitosamente.");</script>';
		} else {
  			echo '<script>alert("Error al registrar la donación: ' . mysqli_error($conn) . '");</script>';
		}
		
		//Cerrar conexión
		mysqli_close($conn);
	}
	
	public function consultarMonetario ($valorMonto, $valorFecha) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Consulta_M.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$monetario = new Monetario();
		$monetario->setMonto($valorMonto);
		$monetario->setFecha($valorFecha);
		$fecha = $monetario->getFecha($valorFecha);
		$monto = $monetario->getMonto($valorMonto);
		
		//Query
		// Construir la cláusula WHERE para la consulta SQL
	    $where_clause = "";
	    if(!empty($fecha) && !empty($monto)){
			$mes = $monetario->obtenerMes();
			$año = $monetario->obtenerAño();
			$monto = $monetario->getMonto();
	        $where_clause = "WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$año' AND monto = $monto";
	    } elseif(!empty($monto)){
			$monto = $monetario->getMonto();
	        $where_clause = "WHERE monto = $monto";
	    } elseif(!empty($fecha)){
			$mes = $monetario->obtenerMes();
			$año = $monetario->obtenerAño();
	        $where_clause = "WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$año'";
	    }
		// Realizar la consulta en la base de datos
	    $sql = "SELECT * FROM donacion_mon $where_clause";
	    $result = $conn->query($sql);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
	
	public function modificarMonetario ($valorNombre, $valorMonto, $valorFecha, $valorId) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Modificar_M.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$monetario = new Monetario();
		$monetario->setMonto($valorMonto);
		$monetario->setFecha($valorFecha);
		$monetario->setNombre($valorNombre);
		$nombre = $monetario->getNombre();
		$fecha = $monetario->getFecha();
		$monto = $monetario->getMonto();
		
		//Query
		// Actulizar la fila correspodiente
	    $sql = "UPDATE donacion_mon SET Nombre='$nombre', Monto=$monto, Fecha='$fecha' WHERE IdMonetaria=$valorId";
    	if ($conn->query($sql) === TRUE) {
      		echo "<script>alert('La transferencia se actualizó correctamente');</script>";
    	} else {
      		echo "Error al actualizar la transferencia: " . $conn->error;
    	}
		
		mysqli_close($conn);
	}
	
	public function eliminarMonetario ($valorId) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Eliminar_M.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		
		//Query
		// Eiminar la fila correspodiente
	    $sql = "DELETE FROM donacion_mon WHERE IdMonetaria=$valorId";
  		if ($conn->query($sql) === TRUE) {
    		echo "<script>alert('La transferencia se eliminó correctamente');</script>";
  		} else {
    		echo "Error al eliminar la transferencia: " . $conn->error;
  		}
		
		mysqli_close($conn);
	}
}
?>