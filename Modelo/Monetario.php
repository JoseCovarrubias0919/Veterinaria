<?php
class Monetario {
    // Atributos
    private $nombre;
    private $monto;
	private $fecha;
    
    // Sets y Gets
    public function getNombre() {
        return $this->nombre;
    }
	
	public function setNombre($valorNombre) {
        $this->nombre = $valorNombre;
    }
	
	public function getMonto() {
        return $this->monto;
    }
	
	public function setMonto($valorMonto) {
        $this->monto = $valorMonto;
    }
	
	public function getFecha() {
        return $this->fecha;
    }
	
	public function setFecha($valorFecha) {
        $this->fecha = $valorFecha;
    }
	
	//Acciones
	public function obtenerMes() {
        $mes = date("m", strtotime($this->fecha));
		return $mes;
    }
	
	public function obtenerAño(){
		$año = date("Y", strtotime($this->fecha));
		return $año;
	}
	
	public function obtenerMonto_min() {
		$monto = $this->monto;
        $monto_min = $monto - 500;
		return $monto_min;
    }
	
	public function obtenerMonto_max(){
		$monto = $this->monto;
		$monto_max = $monto + 500;
		return $monto_max;
	}
}
?>