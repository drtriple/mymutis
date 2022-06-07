<?php 
require_once("../../db/conexion.php");
require_once("redSocial.php");

class crudRedSocial{

    public function __construct(){

    }

    public function listarRedes(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM redsocial');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function crearRedSocial(redSocial $red){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        redsocial(nombreRedSocial,hipervinculo)
        VALUES(:nombreRedSocial,:hipervinculo) ');

        $sql->bindValue('nombreRedSocial', $red->getnombreRedSocial());
        $sql->bindValue('hipervinculo', $red->gethipervinculo());
  
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

    public function actualizarRedSocial(redSocial $red){
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE redsocial
        SET 
        nombreRedSocial=:nombreRedSocial,
        hipervinculo=:hipervinculo
         WHERE idRedSocial=:idRedSocial  
         ');
        $sql->bindValue('nombreRedSocial',$red->getnombreRedSocial());
        $sql->bindValue('hipervinculo', $red->gethipervinculo());
        $sql->bindValue('idRedSocial', $red->getidRedSocial());
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