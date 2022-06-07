<?php
require_once("../../db/conexion.php");
require_once("pregunta.php");

class crudPregunta
{

    public function __construct()
    {
    }

//administrativo y secretario
    public function listarPreguntas($id)
    {
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.nombreUsuarioRespuesta ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaEstadoFecha($estado,$fecha,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.idEstadoPregunta ='.$estado.' AND p.FechaPregunta ='.$fecha.' AND p.nombreUsuarioRespuesta ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaFecha($fecha,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.FechaPregunta ='.$fecha.' AND p.nombreUsuarioRespuesta ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaEstado($estado,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.idEstadoPregunta ='.$estado.' AND p.nombreUsuarioRespuesta ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }


    //ESTUDIANTES, DOCENTES, INTERNOS
    public function listarPreguntasVarios($id)
    {
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.idUsuarioCreador ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaEstadoFechaVarios($estado,$fecha,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.idEstadoPregunta ='.$estado.' AND p.FechaPregunta ='.$fecha.' AND p.idUsuarioCreador ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaFechaVarios($fecha,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.FechaPregunta ='.$fecha.' AND p.idUsuarioCreador ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarPreguntaEstadoVarios($estado,$id){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT p.idPregunta,p.idEstadoPregunta,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Creador,p.DesPregunta,p.FechaPregunta,e.descPregunta,p.FechaRespuestaPregunta,p.RespuestaPregunta,CONCAT(us.nombresUsuario," ",us.apellidosUsuario) as responder FROM (((pregunta p INNER JOIN usuario us ON us.idUsuario = p.nombreUsuarioRespuesta) INNER JOIN usuario u ON u.idUsuario = p.idUsuarioCreador) INNER JOIN estadopregunta e ON e.idEstadoPregunta = p.idEstadoPregunta) WHERE p.idEstadoPregunta ='.$estado.' AND p.idUsuarioCreador ='.$id);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    //
    public function filtrarRol(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT * FROM rol WHERE idRol > 1');
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarRolDocente(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT * FROM rol WHERE idRol BETWEEN 4 AND 5');
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarUsuarioR($Rol){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->query('SELECT u.idUsuario, u.idRolUsuario, CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Profesor FROM usuario u inner join rol r ON r.idRol = u.idRolUsuario WHERE u.idRolUsuario = '.$Rol);
        //Ejecutar la consulta
        $sql->Execute();
        Conexion::Desconectar($baseDatos);
        return ($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

  public function crearPregunta(pregunta $preg)
    {
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO pregunta(idUsuarioCreador,DesPregunta,FechaPregunta,nombreUsuarioRespuesta,idEstadoPregunta)
        VALUES (:idUsuarioCreador,:DesPregunta,:FechaPregunta,:nombreUsuarioRespuesta,2)');
        $sql->bindValue('idUsuarioCreador', $preg->getidUsuarioCreador());
        $sql->bindValue('DesPregunta', $preg->getDesPregunta());
        $sql->bindValue('FechaPregunta', $preg->getFechaPregunta());
        $sql->bindValue('nombreUsuarioRespuesta', $preg->getnombreUsuarioRespuesta());

        try {
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Envío Exitoso";
        } catch (Exepcion $preg) {
            $mensaje = $preg->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.

    }

    public function responderPregunta(pregunta $preg)
    {
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE pregunta SET
         idEstadoPregunta=1, RespuestaPregunta=:RespuestaPregunta, nombreUsuarioRespuesta=:nombreUsuarioRespuesta,
         FechaRespuestaPregunta=:FechaRespuestaPregunta
         WHERE idPregunta=:idPregunta');

        $sql->bindValue('RespuestaPregunta', $preg->getRespuestaPregunta());
        $sql->bindValue('nombreUsuarioRespuesta', $preg->getnombreUsuarioRespuesta());
        $sql->bindValue('FechaRespuestaPregunta', $preg->getFechaRespuestaPregunta());
        $sql->bindValue('idPregunta', $preg->getidPregunta());

        try{
            $sql->execute(); 
            $mensaje =  "Registro Exitoso";
        }
        catch(Excepcion $preg){
            $mensaje = $preg->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }


    public function eliminarPregunta($idPreguntaEliminar)
    {
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM pregunta
         WHERE idPregunta  =:idPregunta 
         ');
        $sql->bindValue('idPregunta', $idPreguntaEliminar);
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
