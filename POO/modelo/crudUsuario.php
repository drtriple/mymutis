<?php 
require_once("../../db/conexion.php");
require_once("usuario.php");

class crudUsuario{

    public function __construct(){

    }

    public function setUser($usu){

        $query = Conexion::Conectar()->prepare("SELECT * FROM usuario WHERE docUsuario = :user");
        $query->execute(['user'=>$usu]);

        foreach ($query as $dbUser) {

            return $dbUser['idUsuario'];          
        }
    }

    public function unUsuariogxg($documento)
    {
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT gg.descGrado, gg.descGrupo FROM gradoxgrupoxusuario gxg INNER JOIN usuario u ON gxg.idUsuarios = u.idUsuario INNER JOIN gradoxgrupo gg ON gxg.idGG = gg.idGradoxGrupo where u.docUsuario = $documento");
        $sql->execute(); //Ejecutar la consulta
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return ($sql->fetchAll()); //Retornar el registro consultado.
    }

    public function extraerNameDoc($i){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT imagenUsuario FROM usuario WHERE docUsuario='.$i);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch(); //retornar de la consulta.
    }

    public function listarDocentes(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, e.descr as estado,u.nombresUsuario,d.idDocenteAsignatura,u.apellidosUsuario,u.correoUsuario,(SELECT nombreAsignatura FROM asignatura a WHERE a.idAsignatura = d.idAsignatura) as asignatura,(SELECT CONCAT(descGrado," ",descGrupo) FROM gradoxgrupo a WHERE a.idGradoxGrupo = g.idGG) as grupo FROM (((usuario u INNER JOIN gradoxgrupoxusuario g ON g.idUsuarios = u.idUsuario) INNER JOIN docenteasignatura d ON u.idUsuario = d.idUsuario) INNER JOIN estadousuario e ON u.estadoUser = e.idEstadoUsuario) WHERE u.idRolUsuario=3 ORDER BY u.apellidosUsuario ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarUsuarios(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, u.nombresUsuario,u.apellidosUsuario,u.correoUsuario,r.descripcionRol,e.descr as estado,t.descr FROM (((usuario u INNER JOIN estadousuario e ON u.estadoUser = e.idEstadoUsuario) INNER JOIN tipodocumento t ON t.idTipoDocumento = u.tipoDocumento) INNER JOIN rol r ON r.idRol = u.idRolUsuario) WHERE u.idRolUsuario IN(2,4,5) ORDER BY u.apellidosUsuario ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEstudiantes(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, u.nombresUsuario,u.apellidosUsuario,u.correoUsuario,u.correoAcudiente,es.descr  as estado,t.descr, (SELECT CONCAT(descGrado," ",descGrupo) FROM gradoxgrupo a WHERE a.idGradoxGrupo = g.idGG) as grupo FROM (((usuario u INNER JOIN gradoxgrupoxusuario g ON g.idUsuarios = u.idUsuario ) INNER JOIN tipodocumento t ON t.idTipoDocumento = u.tipoDocumento) INNER JOIN estadousuario es ON es.idEstadoUsuario = u.estadoUser) WHERE u.idRolUsuario=1 ORDER BY u.apellidosUsuario ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEstudiantesFiltrar($doc){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, u.nombresUsuario,u.apellidosUsuario,u.correoUsuario,u.correoAcudiente,es.descr  as estado,t.descr, (SELECT CONCAT(descGrado," ",descGrupo) FROM gradoxgrupo a WHERE a.idGradoxGrupo = g.idGG) as grupo FROM (((usuario u INNER JOIN gradoxgrupoxusuario g ON g.idUsuarios = u.idUsuario ) INNER JOIN tipodocumento t ON t.idTipoDocumento = u.tipoDocumento) INNER JOIN estadousuario es ON es.idEstadoUsuario = u.estadoUser) WHERE u.idRolUsuario=1 AND u.docUsuario='.$doc);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEstudiantesFiltrarGradoxGrupo($gg){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, u.nombresUsuario,u.apellidosUsuario,u.correoUsuario,u.correoAcudiente,es.descr  as estado,t.descr, (SELECT CONCAT(descGrado," ",descGrupo) FROM gradoxgrupo a WHERE a.idGradoxGrupo = g.idGG) as grupo FROM (((usuario u INNER JOIN gradoxgrupoxusuario g ON g.idUsuarios = u.idUsuario ) INNER JOIN tipodocumento t ON t.idTipoDocumento = u.tipoDocumento) INNER JOIN estadousuario es ON es.idEstadoUsuario = u.estadoUser) WHERE u.idRolUsuario=1 AND g.idGG ='.$gg);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEstudiantesFiltrarggYDocumento($doc,$gg){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT u.idUsuario,u.docUsuario, u.nombresUsuario,u.apellidosUsuario,u.correoUsuario,u.correoAcudiente,es.descr  as estado,t.descr, (SELECT CONCAT(descGrado," ",descGrupo) FROM gradoxgrupo a WHERE a.idGradoxGrupo = g.idGG) as grupo FROM (((usuario u INNER JOIN gradoxgrupoxusuario g ON g.idUsuarios = u.idUsuario ) INNER JOIN tipodocumento t ON t.idTipoDocumento = u.tipoDocumento) INNER JOIN estadousuario es ON es.idEstadoUsuario = u.estadoUser) WHERE u.idRolUsuario=1 AND u.docUsuario='.$doc.' AND g.idGG ='.$gg);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarEstudiantesInactivos(){
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query('SELECT CONCAT(gg.descGrado," ",gg.descGrupo) as grupo,g.idGG,u.idUsuario,u.docUsuario,CONCAT(u.nombresUsuario," ",u.apellidosUsuario) as nombre, u.correoUsuario FROM ((usuario u LEFT JOIN gradoxgrupoxusuario g ON u.idUsuario = g.idUsuarios) LEFT JOIN gradoxgrupo gg ON gg.idGradoxGrupo = g.idGG) WHERE idRolUsuario=1 AND estadoUser=2 ORDER BY idUsuario DESC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function crearUsuario(Usuario $usu,$pass){
        $mensaje = "";
        //contrasena aletoria
    
        $md5Contrasena = md5($pass);
       
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
             
                $sql = $baseDatos->prepare('INSERT INTO 
                usuario(docUsuario, contrasenaUsuario,nombresUsuario, apellidosUsuario,correoUsuario,correoAcudiente,idRolUsuario,tipoDocumento,estadoUser)
                VALUES(:docUsuario, :contrasenaUsuario,:nombresUsuario, :apellidosUsuario,:correoUsuario,:correoAcudiente,:idRolUsuario,:tipoDocumento,1)');
                $sql->bindValue('docUsuario', $usu->getdocUsuarios());
                $sql->bindValue('contrasenaUsuario', $md5Contrasena);
                $sql->bindValue('nombresUsuario', $usu->getnombresUsuarios());
                $sql->bindValue('apellidosUsuario', $usu->getapellidosUsuarios());
                $sql->bindValue('correoUsuario', $usu->getcorreoUsuarios());
                $sql->bindValue('correoAcudiente', $usu->getcorreoAcudiente());
                $sql->bindValue('idRolUsuario', $usu->getidRolUsuario());
                $sql->bindValue('tipoDocumento', $usu->gettipoDocumento());
            

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

    public function unUsuario($documento)
    {
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT u.idUsuario,u.docUsuario,u.nombresUsuario,u.imagenUsuario,u.apellidosUsuario,u.correoUsuario,u.contrasenaUsuario,e.descr,r.descripcionRol FROM ((usuario u INNER JOIN estadousuario e ON u.estadoUser =  e.idEstadoUsuario) INNER JOIN rol r ON u.idRolUsuario = r.idRol) WHERE docUsuario = $documento");
        $sql->execute(); //Ejecutar la consulta
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $sql->fetch(); //Retornar el registro consultado.
    }

    public function actualizarUsuarioContrasena(Usuario $usu){
        $mensaje = "";

        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        contrasenaUsuario=:contrasenaUsuario
         WHERE docUsuario =:idUsuario 
         ');
        $sql->bindValue('contrasenaUsuario',$usu->getcontrasenaUsuarios());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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

    public function actualizarUsuarioImagen(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        imagenUsuario=:imagenUsuario 
         WHERE docUsuario =:idUsuario 
         ');
        $sql->bindValue('imagenUsuario', $usu->getimagenUsuario());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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
    
    public function actualizarUsuarioCorreo(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        correoUsuario=:correoUsuario
        WHERE docUsuario =:idUsuario 
         ');
        $sql->bindValue('correoUsuario', $usu->getcorreoUsuarios());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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

    public function actualizarUsuarioCorreoAcudiente(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        correoAcudiente=:correoAcudiente
        WHERE docUsuario =:idUsuario 
         ');
        $sql->bindValue('correoAcudiente', $usu->getcorreoAcudiente());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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

    public function actualizarEstado(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        estadoUser=:estadoUser
        WHERE idUsuario =:idUsuario 
         ');
        $sql->bindValue('estadoUser', $usu->getestadoUser());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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

    public function actualizarUsuario(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        correoUsuario =:correoUsuario,
        tipoDocumento=:tipoDocumento,
        estadoUser=:estadoUser
        WHERE idUsuario =:idUsuario 
         ');
        $sql->bindValue('correoUsuario', $usu->getcorreoUsuarios());
        $sql->bindValue('tipoDocumento', $usu->gettipoDocumento());
        $sql->bindValue('estadoUser', $usu->getestadoUser());
        $sql->bindValue('idUsuario', $usu->getidUsuario());
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

    public function actualizarTipoDocumento(Usuario $usu){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE usuario
        SET 
        tipoDocumento=:tipoDocumento
        WHERE docUsuario =:idUsuario 
         ');
        $sql->bindValue('tipoDocumento', $usu->gettipoDocumento());
        $sql->bindValue('idUsuario', $usu->getdocUsuarios());
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