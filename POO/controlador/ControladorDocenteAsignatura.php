<?php 
require_once("../../modelo/crudDocenteAsignatura.php");
require_once("../../modelo/docenteAsignatura.php");

class ControladorDocenteAsignatura{
    public function __construct(){

    }

    public function asignarAsignaturas($d1,$d2){
        $da = new docenteAsignatura();
        $da->setidUsuario($d1);
        $da->setidAsignatura($d2);

        $cda = new crudDocenteAsignatura();
       $cda->asignarAsignaturas($da);
    }

    public function actualizarAsignatura($d1,$d2,$asig2){
        $da = new docenteAsignatura();
        $da->setidUsuario($d1);
        $da->setidAsignatura($d2);

        $cda = new crudDocenteAsignatura();
        $cda->actualizarAsignatura($da,$asig2);
    }

}

?>