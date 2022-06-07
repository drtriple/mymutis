<?php 
class redSocial{

    private $idRedSocial;
    private $nombreRedSocial;
    private $hipervinculo;

    public function __construct(){

    }

    //SETS
    public function setidRedSocial($idRedSocials){
        $this->idRedSocial = $idRedSocials;
    }

    public function setnombreRedSocial($nombreRedSocials){
        $this->nombreRedSocial = $nombreRedSocials;
    }

    public function sethipervinculo($hipervinculos){
        $this->hipervinculo = $hipervinculos;
    }

      //GETS
      public function getidRedSocial(){
        return $this->idRedSocial;
    }

    public function getnombreRedSocial(){
        return $this->nombreRedSocial;
    }

    public function gethipervinculo(){
        return $this->hipervinculo;
    }

}

?>