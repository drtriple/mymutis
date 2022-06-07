<?php
require_once("usuario.php");
require_once("cita.php");
class correo{

    public function enviarCorreo(Usuario $usu){

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
                      <img src="https://i.ibb.co/x6WqZsy/correoadmin.png" alt="" width="300" style="height:auto;display:block;" />
                    </td>
                  </tr>
                  <tr>
                    <td style="padding:36px 30px 42px 30px;">
                      <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="padding:0 0 36px 0;">
                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">SE LE HA ASIGNADO UNA CUENTA</h1>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">Ha usted le han asignado una cuenta en la aplicación web MY MUTIS. Te damos la bienvenida y esperamos que disfrutes de sus funciones!<br>
                                                <br><b>Usuario:</b> '.$usu->getdocUsuarios().' <br>
                                                <b>Tipo de Usuario:</b> '.$usu->getidRolUsuario().' <br>
                                                <b>Contraseña:</b> '.$usu->getcontrasenaUsuarios().' </p>
        
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
                
                $email = $usu->getcorreoUsuarios();
                $header = "From: appmymutis@mymutis.com". "\r\n";
                $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header.= "Reply-To: appmymutis@mymutis.com" . "\r\n";
                $header.= "X-Mailer: PHP/". phpversion();
                $mail =  mail($email,$asunto, $msg, $header);
               if ($mail) {
                $mensaje =  "Email Exitoso";
                  
                    
             } 

    }

    public function enviarCorreoAcudiente($correo,$usuario,$contrasena){

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
                    <img src="https://i.ibb.co/x6WqZsy/correoadmin.png" alt="" width="300" style="height:auto;display:block;" />
                  </td>
                </tr>
                <tr>
                  <td style="padding:36px 30px 42px 30px;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        <td style="padding:0 0 36px 0;">
                          <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">SE LE HA ASIGNADO UNA CUENTA</h1>
                          <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">Ha usted le han asignado una cuenta en la aplicación web MY MUTIS. Te damos la bienvenida y esperamos que disfrutes de sus funciones!<br>
                                              <br><b>Usuario:</b> '.$usuario.' <br>
                                              <b>Tipo de Usuario:</b> Estudiante <br>
                                              <b>Contraseña:</b> '.$contrasena.' </p>
      
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

    public function enviarCorreoCita($cit,$usu,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante){

      $mensaje = "";
              $asunto = "LE HAN PROGRAMADO UNA CITA";         
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
                            <img src="https://i.ibb.co/QPFXGyb/cita-Correo.png" alt="" width="300" style="height:auto;display:block;" />
                          </td>
                        </tr>
                        <tr>
                          <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                              <tr>
                                <td style="padding:0 0 36px 0;">
                                  <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">Te han programado una cita</h1>
                                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">
                                Cita agendada por:<b>'.$nombreCitador.'</b><br>
                                El '.$rol.' '.$nombreCitador.' le ha agendado al estudiante '.$nombreEstudiante.' identificado con el número de documento '.$documentoEstudiante.', 
                                una cita en la Institución Educativa José Celestino Mutis.<br><br>
                                <b>Fecha de la cita:</b> '.$cit->getfechaCita().' <br>
                                <b>Hora de la cita:</b> '.$hora.' <br>
                                <b>Motivo de la cita: '.$cit->getdescr().'</b><br><br>
                                Recuerde que usted como su acudiente debe asistir de madera puntual a la cita. Si por algún motivo 
                                usted no puede asistir, por favor comunicarselo al citador.
                                  </p>
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
              $email = $usu->getcorreoAcudiente();
              $header = "From: appmymutis@mymutis.com". "\r\n";
              $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $header.= "Reply-To: appmymutis@mymutis.com" . "\r\n";
              $header.= "X-Mailer: PHP/". phpversion();
              $mail =  mail($email,$asunto, $msg, $header);
             if ($mail) {
              $mensaje =  true;
             }
                  
           }

           public function enviarCorreoCitaActualizado($cit,$usu,$hora,$rol,$nombreCitador,$nombreEstudiante,$documentoEstudiante){

            $mensaje = "";
                    $asunto = "LA CITA PROGRAMADA HA SIDO ACTUALIZADA";         
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
                                  <img src="https://i.ibb.co/QPFXGyb/cita-Correo.png" alt="" width="300" style="height:auto;display:block;" />
                                </td>
                              </tr>
                              <tr>
                                <td style="padding:36px 30px 42px 30px;">
                                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                    <tr>
                                      <td style="padding:0 0 36px 0;">
                                        <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">Te han actualizado la cita programada</h1>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">
                                      Cita agendada por:<b>'.$nombreCitador.'</b><br>
                                      El '.$rol.' '.$nombreCitador.' le ha agendado al estudiante '.$nombreEstudiante.' identificado con el número de documento '.$documentoEstudiante.', 
                                      una cita en la Institución Educativa José Celestino Mutis.<br><br>
                                      <b>Fecha de la cita:</b> '.$cit->getfechaCita().' <br>
                                      <b>Hora de la cita:</b> '.$hora.' <br>
                                      <b>Motivo de la cita: '.$cit->getdescr().'</b><br><br>
                                      Recuerde que usted como su acudiente debe asistir de madera puntual a la cita. Si por algún motivo 
                                      usted no puede asistir, por favor comunicarselo al citador.
                                        </p>
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
                    $email = $usu->getcorreoAcudiente();
                    $header = "From: appmymutis@mymutis.com". "\r\n";
                    $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $header.= "Reply-To: appmymutis@mymutis.com" . "\r\n";
                    $header.= "X-Mailer: PHP/". phpversion();
                    $mail =  mail($email,$asunto, $msg, $header);
                   if ($mail) {
                    $mensaje =  "Email Exitoso";
                   }
                        
                 }
           
           public function enviarCorreoActivacion($nombre,$correo){

            $mensaje = "";
                    $asunto = "BIENVENID@ A MY MUTIS!";
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
                          <img src="https://i.ibb.co/r3ycnPz/validacion.png" alt="" width="300" style="height:auto;display:block;" />
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:36px 30px 42px 30px;">
                          <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                              <td style="padding:0 0 36px 0;">
                                <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;color:#C72E26;">CUENTA ACTIVADA</h1>
                                <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#303030;">Hola'.$nombre.' <br>¡Nos encanta que hagas parte de nosotros! Su cuenta de MY MUTIS ha sido activada. Te damos la bienvenida y esperamos que disfrutes de sus funciones!</p>
            
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
                    $mail =  mail($email,$asunto,$msg,$header);
                   if ($mail) {
                    $mensaje =  true;     
                 } 
    
        }

}

?>