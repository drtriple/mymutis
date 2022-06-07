<?php 
require_once("grupoxGrado.php");
require_once("../../db/conexion.php");

class crudGrupoxGrado{

    public function __construct(){

    }

    public function listarGG(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM gradoxgrupo');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function actualizarGG(grupoxGrado $gg){
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE gradoxgrupo
        SET 
        descGrado=:descGrado,descGrupo=:descGrupo	
         WHERE idGradoxGrupo=:idGradoxGrupo  
         ');
        $sql->bindValue('descGrado',$gg->getdescGrado());
        $sql->bindValue('descGrupo',$gg->getdescGrupo());
        $sql->bindValue('idGradoxGrupo', $gg->getidGradoxGrupo());
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

    public function crearGG(grupoxGrado $gg){
        $mensaje = "";
 
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
             
                $sql = $baseDatos->prepare('INSERT INTO 
                gradoxgrupo(descGrado,descGrupo)
                VALUES(:descGrado,:descGrupo)');
                $sql->bindValue('descGrado', $gg->getdescGrado());
                $sql->bindValue('descGrupo', $gg->getdescGrupo());
                            
        try{
            $sql->execute(); 
            $mensaje =  "Registro Exitoso";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }

}
?>