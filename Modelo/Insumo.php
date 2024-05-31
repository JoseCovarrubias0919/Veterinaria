<?php
class Insumo {
    // Atributos
    protected $nombre;
    protected $descripcion;
	protected $cantidad;
	protected $precio;
	protected $tipo_Insu;
    
    // Sets y Gets
    public function getNombre() {
        return $this->nombre;
    }
	
	public function setNombre($valorNombre) {
        $this->nombre = $valorNombre;
    }
	
	public function getDescripcion() {
        return $this->descripcion;
    }
	
	public function setDescripcion($valorDescripcion) {
        $this->descripcion = $valorDescripcion;
    }
	
	public function getPrecio() {
        return $this->precio;
    }
	
	public function setPrecio($valorPrecio) {
        $this->precio = $valorPrecio;
    }
	
	public function getCantidad() {
        return $this->cantidad;
    }
	
	public function setCantidad($valorCantidad) {
        $this->cantidad = $valorCantidad;
    }
	
	public function getTipo_Insu() {
        return $this->tipo_Insu;
    }
	
	public function setTipo_Insu($valorTipo_Insu) {
        $this->tipo_Insu = $valorTipo_Insu;
    }
	
	//Acciones
	
	public function obtenerCantidad_min() {
		$cantidad = $this->cantidad;
        $cantidad_min = $cantidad - 10;
		return $cantidad_min;
    }
	
	public function obtenerCantidad_max(){
		$cantidad = $this->cantidad;
		$cantidad_max = $cantidad + 10;
		return $cantidad_max;
	}
	
	public function obtenerPrecio_min() {
		$precio = $this->precio;
        $precio_min = $precio - 50;
		return $precio_min;
    }
	
	public function obtenerPrecio_max(){
		$precio = $this->precio;
		$precio_max = $precio + 50;
		return $precio_max;
	}
}
?>