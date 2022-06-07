<?php 
require_once("../../modelo/correo.php");
require_once("../../modelo/usuario.php");
class ControladorCorreo{

    public function enviarCorreo($contrasena,$rol){

        $usuario = new Usuario();
        $usuario->setdocUsuarios($_REQUEST['user']);
        $usuario->setcorreoUsuarios($_REQUEST['email']);
        $usuario->setidRolUsuario($rol);
        $usuario->setcontrasenaUsuarios($contrasena);

        $modeloCorreo = new correo();
        $modeloCorreo->enviarCorreo($usuario);
    }

    public function enviarCorreoAcudiente($correo,$usuario,$contrasena){
        $modeloCorreo = new correo();
        $modeloCorreo->enviarCorreoAcudiente($correo,$usuario,$contrasena);
    }

    public function enviarCorreoCita($descr,$fecha,$correo,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante){

        $usuario = new Usuario();
        $cita = new cita();
        $usuario->setdocUsuarios($_REQUEST['idUsuarioCitado']);
        $cita->setfechaCita($fecha);
        $usuario->setcorreoAcudiente($correo);
        $cita->setdescr($descr);

        $modeloCorreo = new correo();
        $modeloCorreo->enviarCorreoCita($cita,$usuario,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante);
    }

    public function enviarCorreoCitaActualizado($descrEditar,$fechaEditar,$correo,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante){

        $usuario = new Usuario();
        $cita = new cita();
        $usuario->setdocUsuarios($_REQUEST['idUsuarioCitadoEditar']);
        $cita->setfechaCita($fechaEditar);
        $usuario->setcorreoAcudiente($correo);
        $cita->setdescr($descrEditar);

        $modeloCorreo = new correo();
        $modeloCorreo->enviarCorreoCitaActualizado($cita,$usuario,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante);
    }

    public function enviarCorreoActivacion($nombre,$correo){
        $modeloCorreo = new correo();
        $modeloCorreo->enviarCorreoActivacion($nombre,$correo);
    }
}
?>