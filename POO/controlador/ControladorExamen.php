<?php 
require_once("../../modelo/crudExamen.php");
require_once("../../modelo/examen.php");

class ControladorExamen{

    public function __construct(){ 

    }
    public function listarCitador($citador){
        $crudExamen = new crudExamen();
        return $crudExamen->listarCitador($citador);
    }

    public function listarExamenes(){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamenes();
    }

    public function listarExamen($asigna){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamen($asigna);
    }
    public function listarAsignaturas(){
        $crudExamen = new crudExamen();
        return $crudExamen->listarAsignaturas();
    }
    public function listarNAsignaturas($idA){
        $crudExamen = new crudExamen();
        $var1 = $crudExamen->listarNAsignaturas($idA);
        $var2 = $var1['nombreAsignatura'];
        return $var2;

    }
    public function listarAsignaturasA($asig){
        $crudExamen = new crudExamen();
        return $crudExamen->listarAsignaturasA($asig);
    }
    public function registrarExamen($citador){
        $exa = new examen();
        $exa->setfechaExamen($_REQUEST['start']);
        $exa->setidGradoxGrupos($_REQUEST['idGradoxGrupos']);
        $exa->setidAsignaturas($_REQUEST['idAsignaturas']);
        $exa->setdescr($_REQUEST['descr']);
        $exa->setidUsuario($citador);


        $crudExamen = new crudExamen();
        return $crudExamen->registrarExamen($exa,$citador);
    }
    public function actualizarExamen(){
        $exa = new examen();
        $exa->setidExamen($_REQUEST['idExamen']);
        $exa->setdescr($_REQUEST['descr']);
        $exa->setidGradoxGrupos($_REQUEST['idGradoxGrupos']);
        $exa->setfechaExamen($_REQUEST['start']);
        
        
      
        $crudExamen = new crudExamen();
        return $crudExamen->actualizarExamen($exa);
    }
    public function EliminarExamen($exa){
        $crudExamen = new crudExamen();
        echo $crudExamen->EliminarExamen($exa);//llamado al metodo del crud
    }
    public function listarAsignaturasP($asig){
        $crudExamen = new crudExamen();
        return $crudExamen->listarAsignaturasP($asig);
    }
    public function listarExamenP($usu,$asig){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamenP($usu,$asig);
    }
    public function listarExamenE($gxg){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamenE($gxg);
    }
    public function listarExamenee($gxg){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamenee($gxg);
    }
    public function listarGG($usu){
        $crudExamen = new crudExamen();
        return $crudExamen->listarGG($usu);
    }

}

?>