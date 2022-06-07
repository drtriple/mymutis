<?php 

class asignatura{

    private $idAsignatura;
    private $nombreAsignatura;

    public function __construct(){

    }

    //SETS
    public function setidAsignatura($idAsignaturas){
        $this->idAsignatura = $idAsignaturas;
    }

    public function setnombreAsignatura($nombreAsignaturas){
        $this->nombreAsignatura = $nombreAsignaturas;
    }

    //GETS
    public function getidAsignatura(){
        return $this->idAsignatura;
    }

    public function getnombreAsignatura(){
        return $this->nombreAsignatura;
    }
}

?>