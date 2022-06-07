<?php

class estadoPregunta{
    private $idEstadoPregunta;
    Private $descPregunta;

    public function __construct(){

    }

    //SETS
    public function setidEstadoPregunta($idEstadoPregunta){
        $this->idEstadoPregunta = $idEstadoPregunta;
    }

    public function setdesPregunta($descPregunta){
        $this->descPregunta = $descPregunta;
    }

    //GETS

    public function getidEstadoPregunta(){
       return $this->idEstadoPregunta;
    }

    public function getdescPregunta(){
        return $this->descPregunta;
    }
}

?>