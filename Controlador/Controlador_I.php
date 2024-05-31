<?php
//Llamada a otros archivos
$direccion = dirname(dirname(__FILE__));
require_once($direccion . '\Modelo\Insumo.php');
require_once($direccion . '\Modelo\Alimento.php');
require_once($direccion . '\Modelo\Medicamento.php');
require_once($direccion . '\Modelo\Objeto.php');
/*require_once($direccion . '\Vista\Consulta_M.php');
require_once($direccion . '\Vista\Eliminar_M.php');
require_once($direccion . '\Vista\Modificar_M.php');*/

class InsumoControl {
	
	//Acciones
	public function registrarInsumo ($valorNombre, $valorDescripcion, $valorPrecio, $valorCantidad, $valorTipo_Insu, $valorSelec_Amimal, $valorMarca, $valorFecha_Cad, $valorPresentacion, $valorTipo_Med, $valorTamaño, $valorEstado, $valorObservacion, $valorTipo_Objeto) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Registrar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$insumo = new Insumo();
		$alimento = new Alimento();
		$medicamento = new Medicamento();
		$objeto = new Objeto();
		$insumo->setNombre($valorNombre);
		$insumo->setDescripcion($valorDescripcion);
		$insumo->setCantidad($valorCantidad);
		$insumo->setPrecio($valorPrecio);
		$insumo->setTipo_Insu($valorTipo_Insu);
		$nombre = $insumo->getNombre();
		$descripcion = $insumo->getDescripcion();
		$cantidad = $insumo->getCantidad();
		$precio = $insumo->getPrecio();
		$tipo_insumo = $insumo->getTipo_Insu();
		$alimento->setSelec_Amimal($valorSelec_Amimal);
		$alimento->setMarca($valorMarca);
		$alimento->setFecha_Cad($valorFecha_Cad);
		$animal = $alimento->getSelec_Amimal();
		$marca = $alimento->getMarca();
		$fecha_caducidad = $alimento->getFecha_Cad();
		$medicamento->setTipo_Med($valorTipo_Med);
		$medicamento->setMarca($valorMarca);
		$medicamento->setFecha_Cad($valorFecha_Cad);
		$medicamento->setPresentacion($valorPresentacion);
		$tipo_medicamento = $medicamento->getTipo_Med();
		$marca = $medicamento->getMarca();
		$presentacion = $medicamento->getPresentacion();
		$fecha_caducidad = $medicamento->getFecha_Cad();
		$objeto->setTamaño($valorTamaño);
		$objeto->setEstado($valorEstado);
		$objeto->setObservacion($valorObservacion);
		$objeto->setTipo_Objeto($valorTipo_Objeto);
		$tamaño = $objeto->getTamaño();
		$estado = $objeto->getEstado();
		$observacion = $objeto->getObservacion();
		$tipo_objeto = $objeto->getTipo_Objeto();
		
		//Query
		if ($tipo_insumo == 'alimento') {
    		// Guardar en la tabla de donacion_ins
    		$query1 = "INSERT INTO donacion_ins (Nombre, Descripcion, Cantidad, Precio, Tipo_Ins) VALUES ('$nombre', '$descripcion', $cantidad, $precio, '$tipo_insumo')";
    		mysqli_query($conn, $query1);
    		// Obtener el id del último registro insertado en donacion_ins
    		$id = mysqli_insert_id($conn);
    		// Insertar en la tabla de alimentos
    		$query2 = "INSERT INTO alimentos (IdInsumos, Fecha_Cad, Marca, Selec_Animal) VALUES ($id, '$fecha_caducidad', '$marca', '$animal')";
    		if (mysqli_query($conn, $query2)) {
      			echo '<script>alert("El registro se insertó correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
  		} else if ($tipo_insumo == 'medicamento') {
    		// Guardar en la tabla de donacion_ins
    		$query1 = "INSERT INTO donacion_ins (Nombre, Descripcion, Cantidad, Precio, Tipo_Ins) VALUES ('$nombre', '$descripcion', $cantidad, $precio, '$tipo_insumo')";
    		mysqli_query($conn, $query1);
    		// Obtener el id del último registro insertado en donacion_ins
    		$id = mysqli_insert_id($conn);
    		// Insertar en la tabla de medicamentos
    		$query2 = "INSERT INTO medicamentos (IdInsumos, Fecha_Cad, Marca, Presentacion, Tipo_Med) VALUES ($id, '$fecha_caducidad', '$marca', '$presentacion', '$tipo_medicamento')";
			if (mysqli_query($conn, $query2)) {
     	 		echo '<script>alert("El registro se insertó correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
   		} else if ($tipo_insumo == 'objeto') {
    		// Guardar en la tabla de donacion_ins
    		$query1 = "INSERT INTO donacion_ins (Nombre, Descripcion, Cantidad, Precio, Tipo_Ins) VALUES ('$nombre', '$descripcion', $cantidad, $precio, '$tipo_insumo')";
    		mysqli_query($conn, $query1);
    		// Obtener el id del último registro insertado en donacion_ins
    		$id = mysqli_insert_id($conn);
    		// Insertar en la tabla de medicamentos
    		$query2 = "INSERT INTO objetos (IdInsumos, Tamaño, Estado, Observacion, Tipo_Objeto) VALUES ($id, '$tamaño', '$estado', '$observacion', '$tipo_objeto')";
			if (mysqli_query($conn, $query2)) {
      			echo '<script>alert("El registro se insertó correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
		}
		
		//Cerrar conexión
		mysqli_close($conn);
	}
	
	public function consultarInsumoG ($valorNombre, $valorCantidad, $valorPrecio, $valorTipo_Insu) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Consultar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		//Llenar Objeto
		$insumo = new Insumo();
		$insumo->setNombre($valorNombre);
		$insumo->setCantidad($valorCantidad);
		$insumo->setPrecio($valorPrecio);
		$insumo->setTipo_Insu($valorTipo_Insu);
		$nombre = $insumo->getNombre();
		$cantidad = $insumo->getCantidad();
		$precio = $insumo->getPrecio();
		$tipo_insumo = $insumo->getTipo_Insu();
		
		//Query
		// Construir la cláusula WHERE para la consulta SQL
		$sql = "SELECT * FROM donacion_ins WHERE Tipo_Ins = '$tipo_insumo'";

		if ($precio != "") {
			$precio_Min = $insumo->obtenerPrecio_min();
			$precio_Max = $insumo->obtenerPrecio_max();
			$sql .= " AND Cantidad BETWEEN $precio_Min AND $precio_Max";
		}
		
		if ($cantidad != "") {
			$cantidad_Min = $insumo->obtenerCantidad_min();
			$cantidad_Max = $insumo->obtenerCantidad_max();
			$sql .= " AND Cantidad BETWEEN $cantidad_Min AND $cantidad_Max";
		}
			
		if ($nombre != "") {
			$sql .= " AND Nombre LIKE '%$nombre%'";
		}
		
	    $result = $conn->query($sql);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
	
	public function consultarInsumoA ($valorSelec_Amimal, $valorMarca, $valorFecha_Cad, $valorSQL) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Consultar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$alimento = new Alimento();
		$alimento->setSelec_Amimal($valorSelec_Amimal);
		$alimento->setMarca($valorMarca);
		$alimento->setFecha_Cad($valorFecha_Cad);
		$animal = $alimento->getSelec_Amimal();
		$marca = $alimento->getMarca();
		$fecha_caducidad = $alimento->getFecha_Cad();
		
		//Query
		// Construir la cláusula WHERE para la consulta SQL
		if ($marca != "") {
			$valorSQL .= " AND Marca LIKE '%$marca%'";
		}
		if ($fecha_caducidad != "") {
			$mes = $alimento->obtenerMes();
			$año = $alimento->obtenerAño();
			$valorSQL .= " AND MONTH(Fecha_Cad) = '$mes' AND YEAR(Fecha_Cad) = '$año'";
		}
		if ($animal != "") {
			$valorSQL .= " AND Selec_Animal = '$animal'";
	    }
		
	    $result = $conn->query($valorSQL);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
	
	public function consultarInsumoM ($valorMarca, $valorFecha_Cad, $valorPresentacion, $valorTipo_Med, $valorSQL) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Consultar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$medicamento = new Medicamento();
		$medicamento->setTipo_Med($valorTipo_Med);
		$medicamento->setMarca($valorMarca);
		$medicamento->setPresentacion($valorPresentacion);
		$medicamento->setFecha_Cad($valorFecha_Cad);
		$tipo_medicamento = $medicamento->getTipo_Med();
		$marca = $medicamento->getMarca();
		$presentacion = $medicamento->getPresentacion();
		$fecha_caducidad = $medicamento->getFecha_Cad();
		
		//Query
		// Construir la cláusula WHERE para la consulta SQL
		if ($marca != "") {
			$valorSQL .= " AND Marca LIKE '%$marca%'";
		}
		if ($fecha_caducidad != "") {
			$mes = $medicamento->obtenerMes();
			$año = $medicamento->obtenerAño();
			$valorSQL .= " AND MONTH(Fecha_Cad) = '$mes' AND YEAR(Fecha_Cad) = '$año'";
		}
		if ($presentacion != "") {
			$valorSQL .= " AND Presentacion = '$presentacion'";
		}
		if ($tipo_medicamento != "") {
			$valorSQL .= " AND Tipo_Med = '$tipo_medicamento'";
		}
		
	    $result = $conn->query($valorSQL);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
	
	public function consultarInsumoO ($valorEstado, $valorTipo_Objeto, $valorSQL) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Consultar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		//Llenar Objeto
		$objeto = new Objeto();
		$objeto->setEstado($valorEstado);
		$objeto->setTipo_Objeto($valorTipo_Objeto);
		$estado = $objeto->getEstado();
		$tipo_objeto = $objeto->getTipo_Objeto();
		
		//Query
		// Construir la cláusula WHERE para la consulta SQL
		if ($estado != "") {
			$valorSQL .= " AND Estado = '$estado'";
		}
		if ($tipo_objeto != "") {
			$valorSQL .= " AND Tipo_Objeto = '$tipo_objeto'";
		}
		
	    $result = $conn->query($valorSQL);
		
		//Cerrar conexión
		mysqli_close($conn);
		
		return $result;
	}
	
	public function modificarInsumo ($valorId, $valorNombre, $valorDescripcion, $valorCantidad, $valorTipo_Insu, $valorSelec_Amimal, $valorMarca, $valorFecha_Cad, $valorTipo_Med, $valorTamaño, $valorEstado, $valorTipo_Objeto) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Modificar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		//Llenar Objeto
		$insumo = new Insumo();
		$alimento = new Alimento();
		$medicamento = new Medicamento();
		$objeto = new Objeto();
		$id = $valorId;
		$insumo->setNombre($valorNombre);
		$insumo->setDescripcion($valorDescripcion);
		$insumo->setCantidad($valorCantidad);
		$insumo->setTipo_Insu($valorTipo_Insu);
		$nombre = $insumo->getNombre();
		$descripcion = $insumo->getDescripcion();
		$cantidad = $insumo->getCantidad();
		$tipo_insumo = $insumo->getTipo_Insu();
		$alimento->setSelec_Amimal($valorSelec_Amimal);
		$alimento->setMarca($valorMarca);
		$alimento->setFecha_Cad($valorFecha_Cad);
		$animal = $alimento->getSelec_Amimal();
		$marca = $alimento->getMarca();
		$fecha_caducidad = $alimento->getFecha_Cad();
		$medicamento->setTipo_Med($valorTipo_Med);
		$medicamento->setMarca($valorMarca);
		$medicamento->setFecha_Cad($valorFecha_Cad);
		$tipo_medicamento = $medicamento->getTipo_Med();
		$marca = $medicamento->getMarca();
		$fecha_caducidad = $medicamento->getFecha_Cad();
		$objeto->setTamaño($valorTamaño);
		$objeto->setEstado($valorEstado);
		$objeto->setTipo_Objeto($valorTipo_Objeto);
		$tamaño = $objeto->getTamaño();
		$estado = $objeto->getEstado();
		$tipo_objeto = $objeto->getTipo_Objeto();
		
		//Query
		if ($tipo_insumo == 'alimento') {
    		// Modificar en la tabla de donacion_ins
			$query1 = "UPDATE donacion_ins SET Nombre = '$nombre', Descripcion = '$descripcion', Cantidad = $cantidad, Tipo_Ins = '$tipo_insumo' WHERE IdInsumos = $id";
			mysqli_query($conn, $query1);

			// Modificar en la tabla de alimentos
			$query2 = "UPDATE alimentos SET Fecha_Cad = '$fecha_caducidad', Marca = '$marca', Selec_Animal = '$animal' WHERE IdInsumos = $id";
			mysqli_query($conn, $query2);

    		if (mysqli_query($conn, $query2)) {
      			echo '<script>alert("El registro se insertó correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
  		} else if ($tipo_insumo == 'medicamento') {
    		// Modificar en la tabla de donacion_ins
			$query1 = "UPDATE donacion_ins SET Nombre = '$nombre', Descripcion = '$descripcion', Cantidad = $cantidad, Tipo_Ins = '$tipo_insumo' WHERE IdInsumos = $id";
			mysqli_query($conn, $query1);

			// Modificar en la tabla de medicamentos
			$query2 = "UPDATE medicamentos SET Fecha_Cad = '$fecha_caducidad', Marca = '$marca', Tipo_Med = '$tipo_medicamento' WHERE IdInsumos = $id";
			mysqli_query($conn, $query2);

			if (mysqli_query($conn, $query2)) {
     	 		echo '<script>alert("El registro se insertó correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
   		} else if ($tipo_insumo == 'objeto') {
    		// Guardar en la tabla de donacion_ins
    		$query1 = "UPDATE donacion_ins SET Nombre = '$nombre', Descripcion = '$descripcion', Cantidad = $cantidad, Tipo_Ins = '$tipo_insumo' WHERE IdInsumos = $id";
    		mysqli_query($conn, $query1);
    		// Obtener el id del último registro insertado en donacion_ins
    		$id = mysqli_insert_id($conn);
    		// Insertar en la tabla de medicamentos
    		$query2 = "UPDATE objetos SET Tamaño = '$tamaño', Estado = '$estado', Tipo_Objeto = '$tipo_objeto' WHERE IdInsumos = $id";
			if (mysqli_query($conn, $query2)) {
      			echo '<script>alert("La modificacion se ingreso correctamente");</script>';
    		} else {
      			echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    		}
		}
		
		//Cerrar conexión
		mysqli_close($conn);
	}
	
	public function eliminarInsumo ($valorId) {
		//Encontrar Archivo
		$direccion = dirname(dirname(__FILE__));
		require_once($direccion . '\Vista\Eliminar_I.php');
		
		// Crear la conexión a la base de datos
		$conn = new mysqli("localhost", "root", "", "donaciones");

		// Comprobar si se ha establecido la conexión correctamente
		if ($conn->connect_error) {
			die("Error de conexión a la base de datos: " . $conn->connect_error);
		}
		
		//Query
		// Eiminar la fila correspodiente
	    $sql = "DELETE FROM donacion_ins WHERE IdInsumos=$valorId";
  		if ($conn->query($sql) === TRUE) {
    		echo "<script>alert('El insumo se eliminó correctamente');</script>";
  		} else {
    		echo "Error al eliminar la transferencia: " . $conn->error;
  		}
		
		mysqli_close($conn);
	}
}
?>