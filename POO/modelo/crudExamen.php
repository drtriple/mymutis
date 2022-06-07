<?php 
require_once("../../db/conexion.php");
require_once("examen.php");

class crudExamen{

    public function __construct(){

    }
    public function listarCitador($DocCitador){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT idUsuario FROM usuario WHERE docUsuario = $DocCitador;");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }


    public function listarExamenes(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM examen');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarAsignaturas(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT * FROM asignatura WHERE idAsignatura < 17');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarNAsignaturas($idA){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT nombreAsignatura FROM asignatura WHERE idAsignatura ='.$idA );
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch(); //retornar todos los registros de la consulta.
    }
    public function listarAsignaturasA($asig){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT * FROM asignatura WHERE idAsignatura = $asig");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarExamen($asigna){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT e.idGradoxGrupos,e.idExamen,e.fechaExamen,e.descr,e.idAsignaturas,CONCAT(u.nombresUsuario,' ',u.apellidosUsuario) AS profesor, a.nombreAsignatura, (SELECT CONCAT(descGrado,' ',descGrupo) FROM gradoxgrupo g WHERE g.idGradoxGrupo = e.idGradoxGrupos) as grado FROM examen e INNER JOIN asignatura a ON a.idAsignatura = e.idAsignaturas INNER JOIN usuario u ON u.idUsuario = e.idUsuarioCitador WHERE a.idAsignatura = $asigna");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registrarExamen(examen $ex,$citador){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        examen(fechaExamen,idGradoxGrupos,idAsignaturas,descr,idUsuarioCitador)
        VALUES(:fechaExamen,:idGradoxGrupos,:idAsignaturas,:descr,:idUsuarioCitador)');
        $sql->bindValue('fechaExamen', $ex->getfechaExamen());
        $sql->bindValue('idGradoxGrupos', $ex->getidGradoxGrupos());
        $sql->bindValue('idAsignaturas', $ex->getidAsignaturas());
        $sql->bindValue('descr', $ex->getdescr());
        $sql->bindValue('idUsuarioCitador', $citador);
       

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
    public function actualizarExamen($ex){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE examen
        SET 
        descr=:descr,
        idGradoxGrupos=:idGradoxGrupos,
        fechaExamen=:fechaExamen
        WHERE idExamen = :idExamen 
         ');
        $sql->bindValue('descr', $ex->getdescr());
        $sql->bindValue('idGradoxGrupos', $ex->getidGradoxGrupos());
        $sql->bindValue('fechaExamen', $ex->getfechaExamen());
        $sql->bindValue('idExamen', $ex->getidExamen());
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
    public function EliminarExamen($idEliminar)
    {
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM examen
         WHERE idExamen  =:idExamen 
         ');
        $sql->bindValue('idExamen', $idEliminar);
        try {
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminacion Exitosa";
        } catch (Excepcion $preg) {
            $mensaje = $preg->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $mensaje; //Return del mensaje de la transacción.
    }
    public function listarExamenP($usuario,$asig){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT DISTINCT e.idExamen,e.idGradoxGrupos,e.fechaExamen,e.descr,e.idAsignaturas,CONCAT(u.nombresUsuario,' ',u.apellidosUsuario) AS profesor
        , a.nombreAsignatura, (SELECT CONCAT(descGrado,' ',descGrupo) FROM gradoxgrupo g WHERE g.idGradoxGrupo = e.idGradoxGrupos) as grado 
        FROM examen e INNER JOIN asignatura a ON a.idAsignatura = e.idAsignaturas INNER JOIN usuario u ON u.idUsuario = e.idUsuarioCitador INNER JOIN docenteasignatura d ON u.idUsuario = d.idUsuario WHERE d.idUsuario = $usuario AND e.idAsignaturas = $asig;");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarAsignaturasP($usuario){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT * FROM asignatura a INNER JOIN docenteasignatura d ON d.idAsignatura = a.idAsignatura WHERE d.idUsuario =$usuario");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarExamenE($gxg){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT e.descr,a.img,a.idAsignatura, e.idExamen,e.fechaExamen,CONCAT(u.nombresUsuario,' ',u.apellidosUsuario) AS profesor, a.nombreAsignatura, (SELECT CONCAT(descGrado,' ',descGrupo) FROM gradoxgrupo g WHERE g.idGradoxGrupo = e.idGradoxGrupos) as grado FROM ((examen e INNER JOIN usuario u ON e.idUsuarioCitador = u.idUsuario) INNER JOIN asignatura a ON a.idAsignatura = e.idAsignaturas) WHERE idGradoxGrupos= $gxg ORDER BY e.idExamen ASC;
        ");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarExamenee($gxg){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT DISTINCT a.idAsignatura, a.img,a.nombreAsignatura FROM ((examen e INNER JOIN usuario u ON e.idUsuarioCitador = u.idUsuario) INNER JOIN asignatura a ON a.idAsignatura = e.idAsignaturas) WHERE idGradoxGrupos= 21 ORDER BY e.idExamen ASC;
        ");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::Desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    public function listarGG($usuario){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT gg.idGG FROM gradoxgrupoxusuario gg inner JOIN usuario u on gg.idUsuarios = u.idUsuario WHERE u.docUsuario=$usuario");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
   

}

?>