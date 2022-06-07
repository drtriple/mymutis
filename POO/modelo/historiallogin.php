<?php 

class historiallogin{

    private $historiallogin;
    private $fechaIngreso;
    private $horaIngreso;
    private $documentousuario;

    public function __construct(){

    }

    //sets
    public function sethistoriallogin($historiallogins){
        $this->historiallogin = $historiallogins;
    }

    public function setfechaIngreso($fechaIng){
        $this->fechaIngreso = $fechaIng;
    }

    public function sethoraIngreso($horaIng){
        $this->horaIngreso = $horaIng;
    }
    public function setdocumentousuario($documentousu){
        $this->documentousuario = $documentousu;
    }

    //gets
    public function gethistoriallogin(){
        return $this->historiallogin;
    }

    public function getfechaIngreso(){
        return $this->fechaIngreso;
    }

    public function gethoraIngreso(){
        return $this->horaIngreso;
    }

    public function getdocumentousuario(){
        return $this->documentousuario;
    }

}


?>