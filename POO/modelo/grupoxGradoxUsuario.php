<?php 
class grupoxGradoxUsuario{

    private $idGGU;
    private $idUsuarios;
    private $idGG;

    public function __construct(){

    }

    //SETS
    public function setidGGU($idGGUs){
        $this->idGGU = $idGGUs;
    }

    public function setidUsuarios($idUsuarioss){
        $this->idUsuarios = $idUsuarioss;
    }

    public function setidGG($idGGs){
        $this->idGG = $idGGs;
    }

    //GETS
    public function getidGGU(){
        return $this->idGGU;
    }

    public function getidUsuarios(){
        return $this->idUsuarios;
    }

    public function getidGG(){
        return $this->idGG;
    }
}

?>