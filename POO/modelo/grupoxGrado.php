<?php 

class grupoxGrado{

    private $idGradoxGrupo;
    private $descGrado;
    private $descGrupo;

    public function __construct(){

    }

    //SETS
    public function setidGradoxGrupo($idGradoxGruposs){
        $this->idGradoxGrupo = $idGradoxGruposs;
    }

    public function setdescGrado($descGrados){
        $this->descGrado = $descGrados;
    }

    public function setdescGrupo($descGrupos){
        $this->descGrupo = $descGrupos;
    }

    //GETS
    public function getidGradoxGrupo(){
        return $this->idGradoxGrupo;
    }

    public function getdescGrado(){
        return $this->descGrado;
    }

    public function getdescGrupo(){
        return $this->descGrupo;
    }

}
?>