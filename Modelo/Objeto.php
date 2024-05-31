<?php
class Objeto {
    // Atributos
    private $tamaño;
    private $estado;
	private $observacion;
	private $tipo_Objeto;
    
    // Sets y Gets
    public function getTamaño() {
        return $this->tamaño;
    }
	
	public function setTamaño($valorTamaño) {
        $this->tamaño = $valorTamaño;
    }
	
	public function getEstado() {
        return $this->estado;
    }
	
	public function setEstado($valorEstado) {
        $this->estado = $valorEstado;
    }
	
	public function getObservacion() {
        return $this->observacion;
    }
	
	public function setObservacion($valorObservacion) {
        $this->observacion = $valorObservacion;
    }
	
	public function getTipo_Objeto() {
        return $this->tipo_Objeto;
    }
	
	public function setTipo_Objeto($valorTipo_Objeto) {
        $this->tipo_Objeto = $valorTipo_Objeto;
    }
	
	//Acciones
}
?>