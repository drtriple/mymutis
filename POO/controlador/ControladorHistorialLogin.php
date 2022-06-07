<?php 

require_once("../../modelo/crudHistorialLogin.php");
require_once("../../modelo/historiallogin.php");

class ControladorHistorialLogin{

    public function __construct(){ 

    }

    public function listarHistorial(){
        $crudHistorialLogin = new crudHistorialLogin();
        return $crudHistorialLogin->listarHistorial();
    }

    public function eliminarHistorial(){
        $crudHistorialLogin = new crudHistorialLogin();
        $crudHistorialLogin->eliminarHistorial();
    }

}
?>