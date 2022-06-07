<?php 
require_once("../../modelo/crudGrupoxGradoxUsuario.php");
require_once("../../modelo/grupoxGradoxUsuario.php");

class ControladorGrupoxGradoxUsuario{

    public function __construct(){

    }

    public function listarGGU($id){
        $ggu = new crudGrupoxGradoxUsuario();
        $variable = $ggu->listarGGU($id);
        $variable2 = $variable['idGG'];
        return $variable2;
    }

    public function asignarGrupoUsuario($d1,$d2){
        $gg = new grupoxGradoxUsuario();
        $gg->setidUsuarios($d1);
        $gg->setidGG($d2);

        $ggu = new crudGrupoxGradoxUsuario();
         $ggu->asignarGrupoUsuario($gg);
    }

    public function actualizarGrupoxGrado($id,$idgg){
        $gg = new grupoxGradoxUsuario();
        $gg->setidUsuarios($id);
        $gg->setidGG($idgg);
    
        $ggu = new crudGrupoxGradoxUsuario();
         $ggu->actualizarGrupoxGrado($gg);
    }

}

?>