<?php 

require_once("../../modelo/crudUsuario.php");
require_once("../../modelo/usuario.php");

class ControladorUsuario{

    public function __construct(){ 

    }

    public function extraerNameDoc($i){
        $crudUsuario = new crudUsuario();
        $variable = $crudUsuario->extraerNameDoc($i);
        $variable2 = $variable['imagenUsuario'];
        return $variable2;
    }

    public function unUsuariogxg($documento){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->unUsuariogxg($documento);
    }

    public function listarDocentes(){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarDocentes();
    }

    public function listarUsuarios(){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarUsuarios();
    }

    public function listarEstudiantes(){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarEstudiantes();
    }

    public function listarEstudiantesFiltrar($d){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarEstudiantesFiltrar($d);
    }

    public function listarEstudiantesFiltrarGradoxGrupo($d){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarEstudiantesFiltrarGradoxGrupo($d);
    }

    public function listarEstudiantesFiltrarggYDocumento($d,$g){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarEstudiantesFiltrarggYDocumento($d,$g);
    }
    
    public function listarEstudiantesInactivos(){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->listarEstudiantesInactivos();
    }

    public function crearUsuario($pass){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($_REQUEST['user']);
        $usuario->setnombresUsuarios($_REQUEST['name']);
        $usuario->setapellidosUsuarios($_REQUEST['apellidos']);
        $usuario->setcorreoUsuarios($_REQUEST['email']);
        $usuario->setcorreoAcudiente($_REQUEST['emailAcudiente']);
        $usuario->setidRolUsuario($_REQUEST['rol']);
        $usuario->settipoDocumento($_REQUEST['tipoDoc']);
       

        $crudUsuario = new crudUsuario();
        echo $crudUsuario->crearUsuario($usuario,$pass);
    }

    public function setUser($usu){
        $crudUsuario = new crudUsuario();
        return $crudUsuario->setUser($usu);
    }

    public function unUsuario($documento)
    {
        $crudUsuario = new crudUsuario();
        $user = $crudUsuario->unUsuario($documento);
        $usuario = new Usuario();

        $usuario->setidUsuario($user['idUsuario']);
        $usuario->setdocUsuarios($user['docUsuario']);
        $usuario->setnombresUsuarios($user['nombresUsuario']);
        $usuario->setimagenUsuario($user['imagenUsuario']);
        $usuario->setapellidosUsuarios($user['apellidosUsuario']);
        $usuario->setcorreoUsuarios($user['correoUsuario']);
        $usuario->setcontrasenaUsuarios($user['contrasenaUsuario']);
        $usuario->setidRolUsuario($user['descripcionRol']);
        $usuario->setestadoUser($user['descr']);

        return $usuario;

    }

    public function actualizarUsuarioContrasena($doc){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->setcontrasenaUsuarios(md5($_REQUEST['contrasena']));
      
        $crudUsuario = new crudUsuario();
        $crudUsuario->actualizarUsuarioContrasena($usuario);
    }

    public function actualizarUsuarioImagen($doc,$image){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->setimagenUsuario($image);
      
        $crudUsuario = new crudUsuario();
         $crudUsuario->actualizarUsuarioImagen($usuario);
    }

    public function actualizarEstado($doc,$es){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->setestadoUser($es);
      
        $crudUsuario = new crudUsuario();
         $crudUsuario->actualizarEstado($usuario);
    }

    public function actualizarUsuarioCorreo($doc,$correo){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->setcorreoUsuarios($correo);
      
        $crudUsuario = new crudUsuario();
        $crudUsuario->actualizarUsuarioCorreo($usuario);
    }

    public function actualizarUsuarioCorreoAcudiente($doc,$correoA){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->setcorreoAcudiente($correoA);
      
        $crudUsuario = new crudUsuario();
         $crudUsuario->actualizarUsuarioCorreoAcudiente($usuario);
    }

    public function actualizarUsuario(){
        $usuario = new Usuario();
        $usuario->setidUsuario($_REQUEST['idUser']);
        $usuario->setcorreoUsuarios($_REQUEST['correoUser']);
        $usuario->settipoDocumento($_REQUEST['tipoDocumento']);
        $usuario->setestadoUser($_REQUEST['estadoUsuario']);
      
        $crudUsuario = new crudUsuario();
       $crudUsuario->actualizarUsuario($usuario);
    }

    public function actualizarTipoDocumento($doc,$td){
        $usuario = new Usuario();
        $usuario->setdocUsuarios($doc);
        $usuario->settipoDocumento($td);

        $crudUsuario = new crudUsuario();
         $crudUsuario->actualizarTipoDocumento($usuario);
    }


}
?>