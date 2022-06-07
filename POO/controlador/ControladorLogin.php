<?php

require_once("POO/modelo/login.php");
require_once("POO/modelo/usuario.php");

    class ControladorLogin{

        public function __construct(){
            
        }
        
        public function registrarUsuario($imagen){
            $usuario = new Usuario();
            $usuario->setdocUsuarios($_REQUEST['user']);
            $usuario->setcontrasenaUsuarios($_REQUEST['pass']);
            $usuario->setnombresUsuarios($_REQUEST['nombres']);
            $usuario->setapellidosUsuarios($_REQUEST['apellidos']);
            $usuario->setcorreoUsuarios($_REQUEST['correo']);
            $usuario->setcorreoAcudiente($_REQUEST['correoAcudiente']);
            $usuario->setimagenUsuario($imagen);
            $usuario->setidRolUsuario($_REQUEST['rol']);
            $usuario->settipoDocumento($_REQUEST['tipoDocumento']);
    
            $crudLogin = new login();
            echo $crudLogin->registrarUsuario($usuario);
        }

        public function registrarIngreso($fechaIngreso,$horaIngreso,$doc,$h){
            $login = new login();
           echo $login->registrarIngreso($fechaIngreso,$horaIngreso,$doc,$h);
        }

        public function existenciaUsuario(Usuario $usu){
            $login = new login();
         
           return $login->existenciaUsuario($usu);
        }

        public function setUser($doc){
            $login = new login();
            $u = $login->setUser($doc);

            $usuario = new Usuario();

                $usuario->setidRolUsuario($u['idRolUsuario']);
                $usuario->setestadoUser($u['estadoUser']);

                return $usuario;
        }

        public function setVariableSesion($usu){
            $login = new login();
            return $login->setVariableSesion($usu);
        }

        public function getVariableSesion(){
            $login = new login();
            return $login->getVariableSesion();
        }

        
    
        public function cerrarSesion(){
            $login = new login();
            return $login->cerrarSesion();
    
        }

        public function enviarCorreoEstudiante($doc,$correo){
            $login = new login();
            $login->enviarCorreoEstudiante($doc,$correo);
        }
        public function enviarCorreoAcudiente($doc,$contra,$correo){
            $login = new login();
            $login->enviarCorreoAcudiente($doc,$contra,$correo);
        }

    }


?>