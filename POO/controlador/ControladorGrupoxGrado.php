<?php 
require_once("../../modelo/crudGrupoxGrado.php");
require_once("../../modelo/grupoxGrado.php");

class ControladorGrupoxGrado{

    public function __construct(){ 

    }

    public function listarGG(){
        $crudGrupoxGrado = new crudGrupoxGrado();
        return $crudGrupoxGrado->listarGG();
    }

    public function actualizarGG($a,$b,$c){
        $grupoxGrado = new grupoxGrado();
        $grupoxGrado->setdescGrado($a);
        $grupoxGrado->setdescGrupo($b);
        $grupoxGrado->setidGradoxGrupo($c);
      
        $crudGrupoxGrado = new crudGrupoxGrado();
        echo $crudGrupoxGrado->actualizarGG($grupoxGrado);
    }

    public function crearGG(){
        $grupoxGrado = new grupoxGrado();
        $grupoxGrado->setdescGrado($_REQUEST['gradoCrear']);
        $grupoxGrado->setdescGrupo($_REQUEST['grupoCrear']);

        $crudGrupoxGrado = new crudGrupoxGrado();
        echo $crudGrupoxGrado->crearGG($grupoxGrado);
    }

}
?>