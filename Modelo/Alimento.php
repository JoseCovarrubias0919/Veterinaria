<?php
class Alimento {
    // Atributos
    private $selec_animal;
    private $marca;
	private $fecha_cad;
    
    // Sets y Gets
    public function getSelec_Amimal() {
        return $this->selec_animal;
    }
	
	public function setSelec_Amimal($valorSelec_Amimal) {
        $this->selec_animal = $valorSelec_Amimal;
    }
	
	public function getMarca() {
        return $this->marca;
    }
	
	public function setMarca($valorMarca) {
        $this->marca = $valorMarca;
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