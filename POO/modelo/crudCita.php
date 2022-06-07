<?php
require_once("../../db/conexion.php");
require_once("cita.php");
require_once("usuario.php");
class crudCita{

    public function __construct(){

    }
    public function listarCitado($idCitado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT DISTINCT correoAcudiente FROM usuario WHERE idUsuario = $idCitado");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
    public function extraerNombreCitado($idCitado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT CONCAT(nombresUsuario,' ',apellidosUsuario) as estudiante FROM usuario WHERE idUsuario = $idCitado");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
     public function extraerDocumentoCitado($idCitado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT docUsuario as Docestudiante FROM usuario WHERE idUsuario = $idCitado");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
    public function listarRol($DocCitado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT idRolUsuario FROM usuario WHERE idUsuario = $DocCitado");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
    public function listarCitador($idCitador){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT u.idUsuario as citador FROM cita c INNER JOIN usuario u ON u.idUsuario = c.idCitador WHERE u.docUsuario = $idCitador");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
    
    public function listarCitas(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarCitasInactivas(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT uu.idUsuario as citador,u.idUsuario as citado ,C.idCita as idcita,e.Descripcion as dcrs,e.idEstadoCita as estadoCita,C.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",C.descr as descr,C.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS from cita C INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = c.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario;
        ');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    
    public function registrarCita($ct,$citador,$citado){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        cita(idCitador,fechaCita,descr,idUsuarioCitado,idEstadoCita,hora)
        VALUES(:idCitador,:fechaCita,:descr,:idUsuarioCitado,1,:hora) ');
        
        $sql->bindValue('idCitador', $citador);
        $sql->bindValue('fechaCita', $ct->getfechaCita());
        $sql->bindValue('descr', $ct->getdescr());
        $sql->bindValue('hora', $ct->gethora());
        $sql->bindValue('idUsuarioCitado', $citado);
        
        
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
    public function actualizarConclusion($cit){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE cita
        SET 
        conclusion=:conclusion,
        idEstadoCita=:idEstadoCita
        WHERE idCita = :idCita 
         ');
        $sql->bindValue('conclusion', $cit->getconclusion());
        $sql->bindValue('idEstadoCita', $cit->getidEstadoCita());
        $sql->bindValue('idCita', $cit->getidCita());
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
    public function actualizarConclusionI($cit){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE cita
        SET 
        conclusion=:conclusion
        WHERE idCita = :idCita 
         ');
        $sql->bindValue('conclusion', $cit->getconclusion());
        $sql->bindValue('idCita', $cit->getidCita());
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
    public function EliminarCita($idCitaEliminar)
    {
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM cita
         WHERE idCita  =:idCita 
         ');
        $sql->bindValue('idCita', $idCitaEliminar);
        try {
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminacion Exitosa";
        } catch (Excepcion $preg) {
            $mensaje = $preg->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }
    public function actualizarCitado($ct){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE cita
        SET
        fechaCita =:fechaCita,
        descr =:descr,
        hora =:hora
        WHERE idCita = :idCita ');
        
        $sql->bindValue('fechaCita', $ct->getfechaCita());
        $sql->bindValue('descr', $ct->getdescr());
        $sql->bindValue('hora', $ct->gethora());
        $sql->bindValue('idCita', $ct->getidCita());
        
        
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
    
    public function listarCitasP($citador){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario WHERE uu.docUsuario ='.$citador);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarCitasE($citado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario WHERE u.docUsuario ='.$citado);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarCitasEstado($estado){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario WHERE CC.idEstadoCita ='.$estado.' ORDER BY CC.idEstadoCita ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    
    public function listarCitasFecha($fecha){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario WHERE CC.FechaCita = '.$fecha);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarCitasDocumento($doc){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CC.hora, uu.idUsuario as citador,u.idUsuario as citado ,CC.idCita as idcita,e.Descripcion as dcrs,CC.conclusion as conclusion,CONCAT(uu.nombresUsuario," ",uu.apellidosUsuario) as "Nombre citador",CC.descr as descr,CC.fechaCita as fecha,u.docUsuario as docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as "Nombre estudiante",u.correoAcudiente as correo,r.descripcionRol as RolP,ro.descripcionRol as RolS, ro.idRol as rol from cita CC INNER JOIN usuario u ON idUsuarioCitado=u.idUsuario INNER JOIN rol r ON r.idrol = u.idRolUsuario Inner join estadocita e ON e.idEstadoCita = CC.idEstadoCita INNER JOIN usuario uu ON idCitador = uu.idUsuario INNER JOIN rol ro ON ro.idrol = uu.idRolUsuario WHERE u.docUsuario = '.$doc );
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarEstudiantes($grup){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario, gxgxu.idGG, CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as Estudiante FROM usuario u inner join gradoxgrupoxusuario gxgxu ON gxgxu.idUsuarios = u.idUsuario WHERE u.idRolUsuario = 1 AND gxgxu.idGG = '.$grup );
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

}
?>