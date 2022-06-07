<?php
require_once("../../modelo/crudCita.php");
require_once("../../modelo/cita.php");
require_once("../../modelo/usuario.php");
class ControladorCita{

    public function __construct(){ 

    }
    public function listarCitador($idCitador){
        //echo $idCitador;
        $crudCitas = new crudCita();
        return $crudCitas->listarCitador($idCitador);
        
    }
    public function listarCitado($idCitado){
        $crudCitas = new crudCita();
        $varible1 = $crudCitas->listarCitado($idCitado);
        $varible2 = $varible1['correoAcudiente'];
        return $varible2;
    }
    public function extraerNombreCitado($idCitado){
        $crudCitas = new crudCita();
        $varible1 = $crudCitas->extraerNombreCitado($idCitado);
        $varible2 = $varible1['estudiante'];
        return $varible2;
    }
    public function extraerDocumentoCitado($idCitado){
        $crudCitas = new crudCita();
        $varible1 = $crudCitas->extraerDocumentoCitado($idCitado);
        $varible2 = $varible1['Docestudiante'];
        return $varible2;
    }
    public function listarRol($DocCitado){
        $crudCitas = new crudCita();
        $varible1 = $crudCitas->listarRol($DocCitado);
        $varible2 = $varible1['idRolUsuario'];
        return $varible2;
    }

    public function listarCitas(){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitas();
    }
    public function listarCitasInactivas(){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasInactivas();
    }
    public function registrarCita($idCitador,$idCitado){
        $crudCita = new crudCita();
        $ct = new cita();
        
        $ct->setidCitador($idCitador);
        $ct->setfechaCita($_REQUEST['FechaCita']);
        $ct->setidUsuarioCitado($idCitado);
        $ct->setdescr($_REQUEST['descr']);
        $ct->sethora($_REQUEST['hora']);
        echo $crudCita->registrarCita($ct,$idCitador,$idCitado);
    }
    public function actualizarConclusion(){
        $cit = new cita();
        $cit->setidCita($_REQUEST['idCitaconclusion']);
        $cit->setconclusion($_REQUEST['conclusionCita2']);
        $cit->setidEstadoCita($_REQUEST['idEstadoCitaconclusion']);
      
        $crudCita = new crudCita();
        echo $crudCita->actualizarConclusion($cit);
    }
    public function actualizarConclusionI(){
        $cit = new cita();
        $cit->setidCita($_REQUEST['idCita']);
        $cit->setconclusion($_REQUEST['conclusionCita']);
      
        $crudCita = new crudCita();
        echo $crudCita->actualizarConclusionI($cit);
    }
    
    public function actualizarCitado(){
        $ct = new cita();
        $ct->setidCita($_REQUEST['idCitaEditar']);
        $ct->setfechaCita($_REQUEST['fechaCitaEditar']);
        $ct->setdescr($_REQUEST['descrEditar']);
        $ct->sethora($_REQUEST['horaEditar']);
        $crudCita = new crudCita();
        echo $crudCita->actualizarCitado($ct);
    }
    
    public function EliminarCita($cit){
        $crudCita = new crudCita();
        echo $crudCita->EliminarCita($cit);//llamado al metodo del crud
    }
  
    public function listarCitasP($citador){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasP($citador);
    }
    public function listarCitasE($citado){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasE($citado);
    }
    public function listarCitasEstado($estado){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasEstado($estado);
    }
    public function listarCitasFecha($fecha){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasFecha($fecha);
    }
    public function listarCitasDocumento($doc){
        $crudCitas = new crudCita();
        return $crudCitas->listarCitasDocumento($doc);
    }
    public function listarEstudiantes($group){
        $crudCitas = new crudCita();
        return $crudCitas->listarEstudiantes($group);
    }

    /*public function listarCitasFecha($grupo){
        $crudExamen = new crudExamen();
        return $crudExamen->listarExamen($grupo);
    }*/

}
?>