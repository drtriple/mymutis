<?php 
require_once("../../modelo/crudRol.php");
require_once("../../modelo/rol.php");

class ControladorRol{

    public function __construct(){ 

    }

    public function listarRoles(){
        $crudRol = new crudRol();
        return $crudRol->listarRoles();
    }

    public function actualizarRol($a,$b){
        $rol = new rol();
        $rol->setidRol($a);
        $rol->setdescripcionRol($b);      
      
        $crudRol = new crudRol();
        $crudRol->actualizarRol($rol);
    }


}
?>