<?php 

require_once("../../modelo/crudRedSocial.php");
require_once("../../modelo/redSocial.php");

class ControladorRedSocial{

    public function __construct(){ 

    }

    public function listarRedes(){
        $crudRedSocial = new crudRedSocial();
        return $crudRedSocial->listarRedes();
    }

    public function crearRedSocial(){
        $redSocial = new redSocial();
        $redSocial->setnombreRedSocial($_REQUEST['nameRedSocial']);
        $redSocial->sethipervinculo($_REQUEST['hiperRedSocial']);
       
        $crudRedSocial = new crudRedSocial();
        $crudRedSocial->crearRedSocial($redSocial);
    }

    public function actualizarRedSocial(){
        $redSocial = new redSocial();
        $redSocial->setnombreRedSocial($_REQUEST['nameRedSocialActualizar']);
        $redSocial->sethipervinculo($_REQUEST['hiperRedSocialActualizar']);
        $redSocial->setidRedSocial($_REQUEST['idRed']);
       
        $crudRedSocial = new crudRedSocial();
        echo $crudRedSocial->actualizarRedSocial($redSocial);
    }

}
?>