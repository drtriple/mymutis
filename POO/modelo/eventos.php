<?php 
class eventos{

    private $idEvento;
    private $fechaInicio;
    private $fechaFin;
    private $nombreEvento;
    private $descEvento;
    private $idUsuarioCreador;
    private $estadoEvento;
    private $nombreDocumentoAnexo;
    private $jornada;

    public function __construct(){

    }

    //SETS
    public function setidEvento($idEventos){
        $this->idEvento = $idEventos;
    }

    public function setfechaInicio($fechaInicios){
        $this->fechaInicio = $fechaInicios;
    }

    public function setfechaFin($fechaFines){
        $this->fechaFin = $fechaFines;
    }


    public function setnombreEvento($nombreEventos){
        $this->nombreEvento = $nombreEventos;
    }

    public function setdescEvento($descEventos){
        $this->descEvento = $descEventos;
    }

    public function setidUsuarioCreador($idUsuarioCreadores){
        $this->idUsuarioCreador = $idUsuarioCreadores;
    }

    public function setestadoEvento($estadoEventos){
        $this->estadoEvento = $estadoEventos;
    }

    public function setnombreDocumentoAnexo($nombreDocumentoAnexos){
        $this->nombreDocumentoAnexo = $nombreDocumentoAnexos;
    }

    public function setjornada($jornadas){
        $this->jornada = $jornadas;
    }

    //GETS
    public function getidEvento(){
        return $this->idEvento;
    }

    public function getfechaInicio(){
        return $this->fechaInicio;
    }

    public function getfechaFin(){
        return $this->fechaFin;
    }

    public function getnombreEvento(){
        return $this->nombreEvento;
    }

    public function getdescEvento(){
        return $this->descEvento;
    }

    public function getidUsuarioCreador(){
        return $this->idUsuarioCreador;
    }

    public function getestadoEvento(){
        return $this->estadoEvento;
    }

    public function getnombreDocumentoAnexo(){
        return $this->nombreDocumentoAnexo;
    }
    public function getjornada(){
        return $this->jornada;
    }

}

?>