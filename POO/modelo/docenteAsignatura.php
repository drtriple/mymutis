<?php 

class docenteAsignatura{

    private $idDocenteAsignatura;
    private $idUsuario;
    private $idAsignatura;

    public function __construct(){

    }

     //SETS
     public function setidDocenteAsignatura($idDocenteAsignaturas){
        $this->idDocenteAsignatura = $idDocenteAsignaturas;
    }

    public function setidUsuario($idUsuarios){
        $this->idUsuario = $idUsuarios;
    }

    public function setidAsignatura($idAsignaturas){
        $this->idAsignatura = $idAsignaturas;
    }

    
    //GETS
    public function getidDocenteAsignatura(){
        return $this->idDocenteAsignatura;
    }

    public function getidUsuario(){
        return $this->idUsuario;
    }

    public function getidAsignatura(){
        return $this->idAsignatura;
    }

}

?>