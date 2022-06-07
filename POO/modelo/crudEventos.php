<?php 
require_once("../../db/conexion.php");
require_once("eventos.php");

class crudEventos{

    public function __construct(){

    }

    public function crearEvento(eventos $ev){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        evento(fechaInicio,fechaFin,nombreEvento,informacionEvento,idUsuarioCreador,idEstadoEvento,nombreDocumentoAnexo,jornada)
        VALUES(:fechaInicio,:fechaFin,:nombreEvento,:informacionEvento,:idUsuarioCreador,1,:nombreDocumentoAnexo,:jornada)');
        $sql->bindValue('fechaInicio', $ev->getfechaInicio());
        $sql->bindValue('fechaFin', $ev->getfechaFin());
        $sql->bindValue('nombreEvento', $ev->getnombreEvento());
        $sql->bindValue('informacionEvento', $ev->getdescEvento());
        $sql->bindValue('idUsuarioCreador', $ev->getidUsuarioCreador());
        $sql->bindValue('nombreDocumentoAnexo',$ev->getnombreDocumentoAnexo());
        $sql->bindValue('jornada',$ev->getjornada());

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


    public function eliminarEvento($idEventoEliminar){
        $mensaje = "";
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM evento
         WHERE idEvento  =:idEvento  
         ');
        $sql->bindValue('idEvento', $idEventoEliminar);
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminacion Exitosa";
        }
        catch(Excepcion $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }

    public function actualizarEventoGeneral(eventos $ev){
        $mensaje = "";
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE evento
        SET 
        nombreEvento=:nombreEvento, informacionEvento=:informacionEvento, idEstadoEvento =:idEstadoEvento,
        fechaInicio=:fechaInicio,fechaFin=:fechaFin,jornada=:jornada
         WHERE idEvento=:idEvento  
         ');
        $sql->bindValue('nombreEvento', $ev->getnombreEvento());
        $sql->bindValue('informacionEvento', $ev->getdescEvento());
        $sql->bindValue('idEstadoEvento', $ev->getestadoEvento());
        $sql->bindValue('fechaInicio', $ev->getfechaInicio());
        $sql->bindValue('fechaFin', $ev->getfechaFin());
        $sql->bindValue('jornada',$ev->getjornada());
        $sql->bindValue('idEvento', $ev->getidEvento());
     
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

    public function actualizarEventoDocumento(eventos $ev){
        $mensaje = "";
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE evento
        SET 
        nombreDocumentoAnexo=:nombreDocumentoAnexo
         WHERE idEvento=:idEvento  
         ');
        $sql->bindValue('nombreDocumentoAnexo',$ev->getnombreDocumentoAnexo());
        $sql->bindValue('idEvento', $ev->getidEvento());
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

    public function extraerNameDoc($i){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT nombreDocumentoAnexo FROM evento WHERE idEvento='.$i);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch(); //retornar de la consulta.
    }

    public function listarEventosAdmin(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT e.idEvento,e.jornada,e.idUsuarioCreador,e.idEstadoEvento,e.fechaInicio,e.fechaFin,e.nombreEvento,e.informacionEvento,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as creador,es.desEstado,e.nombreDocumentoAnexo FROM ((evento e INNER JOIN usuario u ON e.idUsuarioCreador = u.idUsuario) INNER JOIN estadoevento es ON e.idEstadoEvento = es.idEstadoEvento)');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarEventosAdminEstado($idEstado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT e.idEvento,e.jornada,e.idUsuarioCreador,e.idEstadoEvento,e.fechaInicio,e.fechaFin,e.nombreEvento,e.informacionEvento,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as creador,es.desEstado,e.nombreDocumentoAnexo FROM ((evento e INNER JOIN usuario u ON e.idUsuarioCreador = u.idUsuario) INNER JOIN estadoevento es ON e.idEstadoEvento = es.idEstadoEvento) where e.idEstadoEvento ='.$idEstado);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarEventosAdminFecha($fec){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT e.idEvento,e.jornada,e.idUsuarioCreador,e.idEstadoEvento,e.fechaInicio,e.fechaFin,e.nombreEvento,e.informacionEvento,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as creador,es.desEstado,e.nombreDocumentoAnexo FROM ((evento e INNER JOIN usuario u ON e.idUsuarioCreador = u.idUsuario) INNER JOIN estadoevento es ON e.idEstadoEvento = es.idEstadoEvento) where e.fechaInicio ='.$fec);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function filtrarEventosAdminFechaEstado($idEstado,$fec){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT e.idEvento,e.idUsuarioCreador,e.jornada,e.idEstadoEvento,e.fechaInicio,e.fechaFin,e.nombreEvento,e.informacionEvento,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as creador,es.desEstado,e.nombreDocumentoAnexo FROM ((evento e INNER JOIN usuario u ON e.idUsuarioCreador = u.idUsuario) INNER JOIN estadoevento es ON e.idEstadoEvento = es.idEstadoEvento) where e.fechaInicio ='.$fec.' AND e.idEstadoEvento ='.$idEstado);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEventosVarios(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT e.idEvento,e.jornada,e.idUsuarioCreador,e.fechaInicio,e.fechaFin,e.nombreEvento,e.informacionEvento,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as creador,es.desEstado,e.nombreDocumentoAnexo FROM ((evento e INNER JOIN usuario u ON e.idUsuarioCreador = u.idUsuario) INNER JOIN estadoevento es ON e.idEstadoEvento = es.idEstadoEvento) WHERE e.idEstadoEvento = 1');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

}

?>