<?php 

class cita{

    private $idCita;
    private $idCitador;
    private $fechaCita;
    private $descr;
    private $hora;
    private $idUsuarioCitado;
    private $conclusion;
    private $idEstadoCita;
    

    public function __construct(){

    }

    //SETS
    public function setidCita($idCita){
        $this->idCita = $idCita;
    }

    public function setidCitador($idCitador){
        $this->idCitador = $idCitador;
    }
    public function setfechaCita($fechaCita){
        $this->fechaCita = $fechaCita;
    }

    public function setdescr($descr){
        $this->descr = $descr;
    }
    public function sethora($hora){
        $this->hora = $hora;
    }
    public function setidUsuarioCitado($idUsuarioCitado){
        $this->idUsuarioCitado = $idUsuarioCitado;
    }

    public function setconclusion($conclusion){
        $this->conclusion = $conclusion;
    }
    public function setidEstadoCita($idEstadoCita){
        $this->idEstadoCita = $idEstadoCita;
    }

    //GETS
    public function getidCita(){
        return $this->idCita ;
    }

    public function getidCitador(){
        return $this->idCitador;
    }
    public function getfechaCita(){
        return $this->fechaCita ;
    }

    public function getdescr(){
        return $this->descr;
    }
    public function gethora(){
        return $this->hora;
    }
    public function getidUsuarioCitado(){
        return $this->idUsuarioCitado;
    }

    public function getconclusion(){
        return $this->conclusion;
    }
    public function getidEstadoCita(){
        return $this->idEstadoCita;
    }
}

?>