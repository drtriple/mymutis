<?php 
require_once("../../modelo/crudEventos.php");
require_once("../../modelo/eventos.php");

class ControladorEventos{

    public function __construct(){ 

    }


    public function crearEvento($idUser,$nameDoc,$jorna){
        $eve = new eventos();
        $eve->setfechaInicio($_REQUEST['fechaInicioModal']);
        $eve->setfechaFin($_REQUEST['fechaFinalModal']);
        $eve->setnombreEvento($_REQUEST['nombreEventoModal']);
        $eve->setdescEvento($_REQUEST['exampleFormControlTextarea1']);
        $eve->setidUsuarioCreador($idUser);
        $eve->setnombreDocumentoAnexo($nameDoc);
        $eve->setjornada($jorna);

        $crudEvento = new crudEventos();
         $crudEvento->crearEvento($eve);
    }

    public function eliminarEvento($id){
        $crudEvento = new crudEventos();
        echo $crudEvento->eliminarEvento($id);
    }

    public function actualizarEventoGeneral($id,$jorna){
        $eve = new eventos();
        $eve->setidEvento($id);
        $eve->setnombreEvento($_REQUEST['nombreEventoModalActualizar']);
        $eve->setdescEvento($_REQUEST['exampleFormControlTextarea1Actualizar']);
        $eve->setestadoEvento($_REQUEST['estadoActualizar']);
        $eve->setfechaInicio($_REQUEST['fechaInicioModalActualizar']);
        $eve->setfechaFin($_REQUEST['fechaFinalModalActualizar']);
        $eve->setjornada($jorna);

        $crudEvento = new crudEventos();
        $crudEvento->actualizarEventoGeneral($eve);
    }

    public function actualizarEventoDocumento($id,$nameDoc){
        $eve = new eventos();
        $eve->setidEvento($id);
        $eve->setnombreDocumentoAnexo($nameDoc);

        $crudEvento = new crudEventos();
        $crudEvento->actualizarEventoDocumento($eve);
    }

    public function extraerNameDoc($i){
        $crudEvento = new crudEventos();
        $variable = $crudEvento->extraerNameDoc($i);
        $variable2 = $variable['nombreDocumentoAnexo'];
        return $variable2;
    }

    public function listarEventosAdmin(){
        $crudEvento = new crudEventos();
        return $crudEvento->listarEventosAdmin();
    }

    public function filtrarEventosAdminEstado($idEstado){
        $crudEvento = new crudEventos();
        return $crudEvento->filtrarEventosAdminEstado($idEstado);
    }

    public function filtrarEventosAdminFecha($f){
        $crudEvento = new crudEventos();
        return $crudEvento->filtrarEventosAdminFecha($f);
    }

    public function filtrarEventosAdminFechaEstado($idEstado,$f){
        $crudEvento = new crudEventos();
        return $crudEvento->filtrarEventosAdminFechaEstado($idEstado,$f);
    }


    public function listarEventosVarios(){
        $crudEvento = new crudEventos();
        return $crudEvento->listarEventosVarios();
    }

}

?>