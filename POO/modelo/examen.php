<?php 
class examen{

    private $idExamen;
    private $fechaExamen;
    private $idGradoxGrupos;
    private $idAsignaturas;
    private $descr;
    private $idUsuarioCitador;

    public function __construct(){

    }

    //SETS
    public function setidExamen($idExamens){
        $this->idExamen = $idExamens;
    }

    public function setfechaExamen($fechaExamens){
        $this->fechaExamen = $fechaExamens;
    }

    public function setidGradoxGrupos($idGradoxGruposs){
        $this->idGradoxGrupos = $idGradoxGruposs;
    }

    public function setidAsignaturas($idAsignaturass){
        $this->idAsignaturas = $idAsignaturass;
    }

    public function setdescr($descrs){
        $this->descr = $descrs;
    }

    public function setidUsuario($idUsuarioCitador){
        $this->idUsuarioCitador = $idUsuarioCitador;
    }


    //GETS
    public function getidExamen(){
        return $this->idExamen;
    }

    public function getfechaExamen(){
        return $this->fechaExamen;
    }

    public function getidGradoxGrupos(){
        return $this->idGradoxGrupos;
    }

    public function getidAsignaturas(){
        return $this->idAsignaturas;
    }

    public function getdescr(){
        return $this->descr;
    }

    public function getidUsuario(){
        $this->idUsuarioCitador;
    }

}

?>