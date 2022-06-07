<?php

class pregunta{
    private $idPregunta;
    private $idUsuarioCreador ;
    private $DesPregunta;
    private $FechaPregunta;
    private $RespuestaPregunta;
    private $nombreUsuarioRespuesta;
    private $idEstadoPregunta;
    private $FechaRespuestaPregunta;

    public function __construct(){

    }

    //SETS
    public function setidPregunta($idPregunta){
        $this->idPregunta = $idPregunta;
    }

    public function setidUsuarioCreador($idUsuarioCreador){
        $this->idUsuarioCreador = $idUsuarioCreador;
    }

    public function setDesPregunta($DesPregunta){
        $this->DesPregunta = $DesPregunta;
    }

    public function setFechaPregunta($FechaPregunta){
        $this->FechaPregunta = $FechaPregunta;
    }

    public function setRespuestaPregunta($RespuestaPregunta){
        $this->RespuestaPregunta = $RespuestaPregunta;
    }

    public function setnombreUsuarioRespuesta($nombreUsuarioRespuesta){
        $this->nombreUsuarioRespuesta = $nombreUsuarioRespuesta;
    }

    public function setidEstadoPregunta($idEstadoPregunta){
        $this->idEstadoPregunta = $idEstadoPregunta;
    }

    public function setFechaRespuestaPregunta($FechaRespuestaPregunta){
        $this->FechaRespuestaPregunta = $FechaRespuestaPregunta;
    }

    //GETS

    public function getidPregunta(){
        return $this->idPregunta;
    }

    public function getidUsuarioCreador(){
        return $this->idUsuarioCreador;
    }

    public function getDesPregunta(){
        return $this->DesPregunta;
    }

    public function getFechaPregunta(){
        return $this->FechaPregunta;
    }

    public function getRespuestaPregunta(){
        return $this->RespuestaPregunta;
    }

    public function getnombreUsuarioRespuesta(){
        return $this->nombreUsuarioRespuesta;
    }

    public function getidEstadoPregunta(){
        return $this->idEstadoPregunta;
    }

    public function getFechaRespuestaPregunta(){
        return $this->FechaRespuestaPregunta;
    }
}
?>