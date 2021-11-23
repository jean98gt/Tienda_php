<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
class empleados {
    
    private $ndocumento;
    private $contraseña;
    
    
    public function __construct($ndocumento, $contraseña) {
        $this->ndocumento = $ndocumento;
        $this->contraseña = $contraseña;
        
        
    }

    public function getNdocumento() {
        return $this->ndocumento;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setNdocumento($ndocumento): void {
        $this->ndocumento = $ndocumento;
    }

    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }


}
