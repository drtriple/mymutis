<?php 

class rol{

    private $idRol;
    private $descripcionRol;


    public function __construct(){

    }

    //SETS
    public function setidRol($idRols){
        $this->idRol = $idRols;
    }

    public function setdescripcionRol($descripcionRols){
        $this->descripcionRol = $descripcionRols;
    }


    //GETS
    public function getidRol(){
        return $this->idRol;
    }

    public function getdescripcionRol(){
        return $this->descripcionRol;
    }


}
?>