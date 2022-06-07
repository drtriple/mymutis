<?php 
require_once("grupoxGradoxUsuario.php");
require_once("../../db/conexion.php");

class crudGrupoxGradoxUsuario{

    public function __construct(){

    }

    public function listarGGU($id){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT idGG FROM gradoxgrupoxusuario where idUsuarios ='.$id);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }

    public function asignarGrupoUsuario(grupoxGradoxUsuario $gg){
        $mensaje = "";
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        gradoxgrupoxusuario(idUsuarios,idGG)
        VALUES(:idUsuarios,:idGG) ');
        $sql->bindValue('idUsuarios', $gg->getidUsuarios());
        $sql->bindValue('idGG', $gg->getidGG());
       

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

    public function actualizarGrupoxGrado(grupoxGradoxUsuario $gg){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE gradoxgrupoxusuario
        SET 
        idGG=:tipo
        WHERE idUsuarios =:idUsuario 
         ');
        $sql->bindValue('tipo', $gg->getidGG());
        $sql->bindValue('idUsuario', $gg->getidUsuarios());
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