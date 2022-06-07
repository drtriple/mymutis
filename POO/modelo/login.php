<?php 
require_once("POO/db/conexion.php");
require_once("usuario.php");


class login{

    public function __construct(){
      
    }


    public function registrarUsuario(Usuario $usu){
        $mensaje = "";
        $md5Contrasena = md5($usu->getcontrasenaUsuarios());
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        usuario(docUsuario, contrasenaUsuario,nombresUsuario, apellidosUsuario,correoUsuario,correoAcudiente,imagenUsuario,idRolUsuario,tipoDocumento,estadoUser)
        VALUES(:docUsuario, :contrasenaUsuario,:nombresUsuario, :apellidosUsuario,:correoUsuario,:correoAcudiente,:imagenUsuario,:idRolUsuario,:tipoDocumento,"2") ');
        $sql->bindValue('docUsuario', $usu->getdocUsuarios());
        $sql->bindValue('contrasenaUsuario', $md5Contrasena);
        $sql->bindValue('nombresUsuario', $usu->getnombresUsuarios());
        $sql->bindValue('apellidosUsuario', $usu->getapellidosUsuarios());
        $sql->bindValue('correoUsuario', $usu->getcorreoUsuarios());
        $sql->bindValue('correoAcudiente', $usu->getcorreoAcudiente());
        $sql->bindValue('imagenUsuario', $usu->getimagenUsuario());
        $sql->bindValue('idRolUsuario', $usu->getidRolUsuario());
        $sql->bindValue('tipoDocumento', $usu->gettipoDocumento());

        try{
            $sql->execute(); //Ejecutar el sql
           
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
     
    }


    public function existenciaUsuario(Usuario $usu){

       $md5Contrasena = md5($usu->getcontrasenaUsuarios());
            $basedatos = Conexion::Conectar();
 $query = $basedatos->prepare("SELECT * FROM  usuario WHERE docUsuario = :user AND contrasenaUsuario = :pass AND idRolUsuario = :rol");
    
        $query->bindValue('user',$usu->getdocUsuarios());
        $query->bindValue('pass',$md5Contrasena);
        $query->bindValue('rol',$usu->getidRolUsuario());

        try {
            $query->execute();
            if($query->rowCount()){
                return true;
            }
            else{
                return false;
            }

        } catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($basedatos); //Desconectar de la base de datos.
    }

    public function setUser($doc){

        $baseDatos = Conexion::Conectar();
        $sql = $baseDatos->query("SELECT idRolUsuario,estadoUser FROM usuario WHERE docUsuario = $doc");
        $sql->execute(); //Ejecutar la consulta
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
        return $sql->fetch();
    }

    public function setVariableSesion($usu){
        $_SESSION['user'] = $usu;
    }

    public function getVariableSesion(){
        return $_SESSION['user'];
    }

    public function registrarIngreso($fechaIngreso,$horaIngreso,$doc,$h){
     
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::Conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO 
        historiallogin(fechaIngreso,horaIngreso,docUsuario,horario)
        VALUES(:fechaIngreso,:horaIngreso,:docUsuario,:horario ) ');
        $sql->bindValue('fechaIngreso', $fechaIngreso);
        $sql->bindValue('horaIngreso', $horaIngreso);
        $sql->bindValue('docUsuario', $doc);
        $sql->bindValue('horario', $h);

        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Registro Exitoso";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.
     
    }

    
    public function cerrarSesion(){

        session_unset();
        session_destroy();

    }

    public function enviarCorreoEstudiante($doc,$correo){

        $mensaje = "";
                $asunto = "BIENVENID@ | SU USUARIO HA SIDO CREADO EN MY MUTIS";
        $msg = '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <style>
            table, td, div, h1, p {font-family: Arial, sans-serif;}
          </style>
        </head>
        <body style="margin:0;padding:0;">
          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
              <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                  <tr>
                    <td align="center" style="padding:40px 0 30px 0;background:#303030;">
                      <img src="https://i.ibb.co/RbTcxw9/enviarcorreo-Acudiente.png" alt="" width="300" style="height:auto;display:block;" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:36px 30px 42px 30px;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="padding:0 0 36px 0;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">SE LE HA ASIGNADO UNA CUENTA</h1>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">Usted ha creado una cuenta en la aplicación web MY MUTIS. Te damos la bienvenida y esperamos que disfrutes de sus funciones!<br>
                                                <br><b>Usuario:</b> '.$doc.' <br>
                                                <b>Tipo de Usuario:</b> Estudiante <br>
          
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:0;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                  <p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">El presente Política de Privacidad establece los términos en que My Mutis usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. .</p>
                                
                                </td>
                                <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                  <p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Nuestros tiempos de respuesta de cada una de nuestras funciones son los más cortos, esto lo hacemos posible para puedas utilizar el 100% de lo que ofrecemos.</p>
                                
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:30px;background:#303030;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                        <tr>
                          <td style="padding:0;width:50%;" align="left">
                            <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                              &reg; I.E Jose Celestino Mutis, MY MUTIS 2022<br/><a href="https://mymutis.com/" style="color:#ffffff;text-decoration:underline;">mymutis.com</a>
                            </p>
                          </td>
                          <td style="padding:0;width:50%;" align="right">
                            <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="https://www.iemutismedellin.edu.co/" style="color:#ffffff;"><img src="https://cdn.iconscout.com/icon/free/png-256/webpage-1896684-1606144.png" alt="pageweb" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>';        
                
                $email = $correo;
                $header = "From: appmymutis@mymutis.com". "\r\n";
                $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header.= "Reply-To: appmymutis@mymutis.com" . "\r\n";
                $header.= "X-Mailer: PHP/". phpversion();
                $mail =  mail($email,$asunto, $msg, $header);
               if ($mail) {
                $mensaje =  "Email Exitoso";
                  
                    
             } 

    }
    public function enviarCorreoAcudiente($doc,$contra,$correo){

        $mensaje = "";
                $asunto = "BIENVENID@ | SU USUARIO HA SIDO CREADO EN MY MUTIS";
        $msg = '<!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <style>
            table, td, div, h1, p {font-family: Arial, sans-serif;}
          </style>
        </head>
        <body style="margin:0;padding:0;">
          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
              <td align="center" style="padding:0;">
                <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                  <tr>
                    <td align="center" style="padding:40px 0 30px 0;background:#303030;">
                      <img src="https://i.ibb.co/RbTcxw9/enviarcorreo-Acudiente.png" alt="" width="300" style="height:auto;display:block;" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:36px 30px 42px 30px;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="padding:0 0 36px 0;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">SE LE HA ASIGNADO UNA CUENTA</h1>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">Ha usted le han asignado una cuenta en la aplicación web MY MUTIS. Te damos la bienvenida y esperamos que disfrutes de sus funciones!<br>
                                                <br><b>Usuario:</b> '.$doc.' <br>
                                                <b>Tipo de Usuario:</b> Estudiante <br>
                                                <b>Contraseña:</b> '.$contra.' </p>
        
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:0;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                  <p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><img src="https://assets.codepen.io/210284/left.gif" alt="" width="260" style="height:auto;display:block;" /></p>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">El presente Política de Privacidad establece los términos en que My Mutis usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. .</p>
                                
                                </td>
                                <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                                <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                  <p style="margin:0 0 25px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><img src="https://assets.codepen.io/210284/right.gif" alt="" width="260" style="height:auto;display:block;" /></p>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Nuestros tiempos de respuesta de cada una de nuestras funciones son los más cortos, esto lo hacemos posible para puedas utilizar el 100% de lo que ofrecemos.</p>
                                
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:30px;background:#303030;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                        <tr>
                          <td style="padding:0;width:50%;" align="left">
                            <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                              &reg; I.E Jose Celestino Mutis, MY MUTIS 2022<br/><a href="https://mymutis.com/" style="color:#ffffff;text-decoration:underline;">mymutis.com</a>
                            </p>
                          </td>
                          <td style="padding:0;width:50%;" align="right">
                            <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 0 10px;width:38px;">
                                  <a href="https://www.iemutismedellin.edu.co/" style="color:#ffffff;"><img src="https://cdn.iconscout.com/icon/free/png-256/webpage-1896684-1606144.png" alt="pageweb" width="38" style="height:auto;display:block;border:0;" /></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </body>
        </html>';        
                
                $email = $correo;
                $header = "From: appmymutis@mymutis.com". "\r\n";
                $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header.= "Reply-To: appmymutis@mymutis.com" . "\r\n";
                $header.= "X-Mailer: PHP/". phpversion();
                $mail =  mail($email,$asunto, $msg, $header);
               if ($mail) {
                $mensaje =  "Email Exitoso";
                  
                    
             } 

    }

}

?>