<?php 
require_once("rol.php");
require_once("../../db/conexion.php");

class crudRol{

    public function __construct(){

    }

    public function listarRoles(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM rol');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function actualizarRol(rol $r){
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE rol
        SET 
        descripcionRol=:descripcionRol
         WHERE idRol=:idRol   
         ');
        $sql->bindValue('descripcionRol',$r->getdescripcionRol());
        $sql->bindValue('idRol', $r->getidRol());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Modificación Exitosa";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }


}
?>