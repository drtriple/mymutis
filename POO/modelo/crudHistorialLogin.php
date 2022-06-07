<?php 
require_once("../../db/conexion.php");
require_once("historiallogin.php");

class crudHistorialLogin{

    public function __construct(){

    }

    public function listarHistorial(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM historiallogin ORDER BY idLogin DESC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registrarIngreso(historiallogin $hl){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        historiallogin(fechaIngreso,horaIngreso,docUsuario)
        VALUES(:fechaIngreso,:horaIngreso,:docUsuario ) ');
        $sql->bindValue('fechaIngreso', $hl->getfechaIngreso());
        $sql->bindValue('horaIngreso', $hl->gethoraIngreso());
        $sql->bindValue('docUsuario', $hl->getdocumentousuario());
      

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

    public function eliminarHistorial()
    {
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM historiallogin LIMIT 10');
        try {
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminacion Exitosa";
        } catch (Excepcion $preg) {
            $mensaje = $preg->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }

}

?>