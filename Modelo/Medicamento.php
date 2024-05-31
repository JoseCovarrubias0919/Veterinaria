<?php
class Medicamento {
    // Atributos
    private $tipo_med;
    private $marca;
	private $presentacion;
	private $fecha_cad;
    
    // Sets y Gets
    public function getTipo_Med() {
        return $this->tipo_med;
    }
	
	public function setTipo_Med($valorTipo_Med) {
        $this->tipo_med = $valorTipo_Med;
    }
	
	public function getMarca() {
        return $this->marca;
    }
	
	public function setMarca($valorMarca) {
        $this->marca = $valorMarca;
    }
	
	public function getPresentacion() {
        return $this->presentacion;
    }
	
	public function setPresentacion($valorPresentacion) {
        $this->presentacion = $valorPresentacion;
    }
	
	public function getFecha_Cad() {
        return $this->fecha_cad;
    }
	
	public function setFecha_Cad($valorFecha_Cad) {
        $this->fecha_cad = $valorFecha_Cad;
    }
	
	//Acciones
	public function obtenerMes() {
        $mes = date("m", strtotime($this->fecha_cad));
		return $mes;
    }
	
	public function obtenerAño(){
		$año = date("Y", strtotime($this->fecha_cad));
		return $año;
	}
}
?>