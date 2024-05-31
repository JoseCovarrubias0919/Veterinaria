<?php
class Usuario {
    // Atributos
    private $usuario;
    private $contraseña;
	private $permiso;
    
    // Sets y Gets
    public function getUsuario() {
        return $this->usuario;
    }
	
	public function setUsuario($valorUsuario) {
        $this->usuario = $valorUsuario;
    }
	
	public function getContraseña() {
        return $this->contraseña;
    }
	
	public function setContraseña($valorContraseña) {
        $this->contraseña = $valorContraseña;
    }
	
	public function getPermiso() {
        return $this->permiso;
    }
	
	public function setPermiso($valorPermiso) {
        $this->permiso = $valorPermiso;
    }
	
	//Acciones
	
}
?>