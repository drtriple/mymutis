<?php 
require_once("../../db/conexion.php");
require_once("docenteAsignatura.php");

class crudDocenteAsignatura{

    public function __construct(){

    }

    public function asignarAsignaturas(docenteAsignatura $da){
        $mensaje = "";
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        docenteasignatura(idUsuario ,idAsignatura)
        VALUES(:idUsuario ,:idAsignatura) ');
        $sql->bindValue('idUsuario', $da->getidUsuario());
        $sql->bindValue('idAsignatura', $da->getidAsignatura());
       

        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Registro Exitoso";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }

    public function actualizarAsignatura(docenteAsignatura $da,$asig2){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE docenteasignatura
        SET 
        idAsignatura=:idAsignatura
        WHERE idUsuario =:idUsuario AND idDocenteAsignatura=:idAsignatura2
         ');
        $sql->bindValue('idAsignatura', $da->getidAsignatura());
        $sql->bindValue('idUsuario', $da->getidUsuario());
        $sql->bindValue('idAsignatura2', $asig2);
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