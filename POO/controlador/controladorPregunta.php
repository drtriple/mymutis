<?php
require_once("../../modelo/crudPregunta.php");
require_once("../../modelo/pregunta.php");

class controladorPregunta{

    public function __construct(){ 

    }

    //SECRETARIO Y DIRECTIVOS
    public function listarPreguntas($id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->listarPreguntas($id);
    }

    public function filtrarPreguntaEstadoFecha($estado,$fecha,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaEstadoFecha($estado,$fecha,$id);
    }

    public function filtrarPreguntaEstado($estado,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaEstado($estado,$id);
    }

    public function filtrarPreguntaFecha($fecha,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaFecha($fecha,$id);
    }

    //ESTUDIANTES, DOCENTES, INTERNOS
     public function listarPreguntasVarios($id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->listarPreguntasVarios($id);
    }

    public function filtrarPreguntaEstadoFechaVarios($estado,$fecha,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaEstadoFechaVarios($estado,$fecha,$id);
    }

    public function filtrarPreguntaEstadoVarios($estado,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaEstadoVarios($estado,$id);
    }

    public function filtrarPreguntaFechaVarios($fecha,$id){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarPreguntaFechaVarios($fecha,$id);
    }

    //E
    public function filtrarRol(){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarRol();
    }
    public function filtrarRolDocente(){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarRolDocente();
    }
    public function filtrarUsuarioR($rol){
        $crudPregunta = new crudPregunta();
        return $crudPregunta->filtrarUsuarioR($rol);
    }

    public function crearPregunta($id,$fecha){
        
        $preg = new pregunta();
        $preg->setidUsuarioCreador($id);
        $preg->setDesPregunta($_REQUEST['pregunta']);
        $preg->setFechaPregunta($fecha);
        $preg->setnombreUsuarioRespuesta($_REQUEST['Usuario']);

        $crudPregunta = new crudPregunta();
        $crudPregunta->crearPregunta($preg);
    }

    public function responderPregunta($userRes,$fechaRes){

        $preg = new Pregunta();
        $preg->setRespuestaPregunta($_REQUEST['respuestaPregunta']);
        $preg->setnombreUsuarioRespuesta($userRes);
        $preg->setFechaRespuestaPregunta($fechaRes);
        $preg->setidPregunta($_REQUEST['idCitaResponder']);

        $crudPregunta = new crudPregunta();
        $crudPregunta->responderPregunta($preg);
    }

    public function eliminarPregunta($i){

        $crudPregunta = new crudPregunta();
        $crudPregunta->eliminarPregunta($i);
    }


}

?>