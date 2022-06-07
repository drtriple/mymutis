<?php 

class Usuario{

    private $idUsuario;
    private $docUsuarios;
    private $contrasenaUsuario;
    private $nombresUsuarios;
    private $apellidosUsuarios;
    private $correoUsuarios;
    private $correoAcudiente;
    private $imagenUsuario;
    private $idRolUsuario;
    private $tipoDocumento;
    private $estadoUser;

    public function __construct(){

    }

        //SETS
        public function setidUsuario($idUsuarios){
            $this->idUsuario = $idUsuarios;
        }

        public function setdocUsuarios($docUsuarioss){
            $this->docUsuarios = $docUsuarioss;
        }

        public function setcontrasenaUsuarios($contrasenaUsuarioss){
            $this->contrasenaUsuario = $contrasenaUsuarioss;
        }

        public function setnombresUsuarios($nombresUsuarioss){
            $this->nombresUsuarios = $nombresUsuarioss;
        }

        public function setapellidosUsuarios($apellidosUsuarioss){
            $this->apellidosUsuarios = $apellidosUsuarioss;
        }

        public function setcorreoUsuarios($correoUsuarioss){
            $this->correoUsuarios = $correoUsuarioss;
        }

        public function setcorreoAcudiente($correoAcudientes){
            $this->correoAcudiente = $correoAcudientes;
        }

        public function setimagenUsuario($imagenUsuarioss){
            $this->imagenUsuario = $imagenUsuarioss;
        }

        public function setidRolUsuario($idRolUsuarios){
            $this->idRolUsuario = $idRolUsuarios;
        }

        public function settipoDocumento($tipoDocumentos){
            $this->tipoDocumento = $tipoDocumentos;
        }

        public function setestadoUser($estadoUsers){
            $this->estadoUser = $estadoUsers;
        }


        //GETS
        public function getidUsuario(){
            return $this->idUsuario;
        }

        public function getdocUsuarios(){
            return $this->docUsuarios;
        }

        public function getcontrasenaUsuarios(){
            return $this->contrasenaUsuario;
        }

        public function getnombresUsuarios(){
            return $this->nombresUsuarios;
        }

        public function getapellidosUsuarios(){
            return $this->apellidosUsuarios;
        }

        public function getcorreoUsuarios(){
            return $this->correoUsuarios;
        }

        public function getcorreoAcudiente(){
           return $this->correoAcudiente;
        }

        public function getimagenUsuario(){
            return $this->imagenUsuario;
        }

        public function getidRolUsuario(){
            return $this->idRolUsuario;
        }

        public function gettipoDocumento(){
            return $this->tipoDocumento;
        }

        public function getestadoUser(){
            return $this->estadoUser;
        }


}

?>