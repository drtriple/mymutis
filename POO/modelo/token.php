<?php
class token{

  public function token(Usuario $usu){

    $basedatos = Conexion::Conectar();
$query = $basedatos->prepare("SELECT * FROM  usuario WHERE docUsuario = :user AND correoUsuario = :em");

$query->bindValue('user',$usu->getdocUsuarios());
$query->bindValue('em',$usu->getcorreoUsuarios());

try {
    $query->execute();
    if($query->rowCount()){
        return true;
    }
    else{
        return false;
    }

} catch (Exception $e) {
    echo $e->getMessage();
}
    Conexion::Desconectar();
}

public function verificarToken($c,$docu){

    $basedatos = Conexion::Conectar();
    $query = $basedatos->prepare("SELECT * FROM  tokenverificacion WHERE codigo = :codigo AND documentoUsuario = :doc");

    $query->bindValue('codigo',$c);
    $query->bindValue('doc',$docu);
    try {
    $query->execute();
    if($query->rowCount()){
      return true;
    }
    else{
      return false;
    }

    } catch (Exception $e) {
    echo $e->getMessage();
    }
    Conexion::Desconectar();
}

public function verificarTokenExistenciaUser($docu){

  $basedatos = Conexion::Conectar();
  $query = $basedatos->prepare("SELECT * FROM  tokenverificacion WHERE documentoUsuario = :doc");

  $query->bindValue('doc',$docu);
  try {
  $query->execute();
  if($query->rowCount()){
    return true;
  }
  else{
    return false;
  }

  } catch (Exception $e) {
  echo $e->getMessage();
  }
  Conexion::Desconectar();
}

public function crearToken($codigo,$fecha,$hora,$doc){

//Establecer la conexión a la base datos
$baseDatos = Conexion::Conectar();
//Preparar la sentencia sql
$sql = $baseDatos->prepare('INSERT INTO 
tokenverificacion(codigo,fecha,hora,documentoUsuario)
VALUES(:codigo,:fecha,:hora,:documentoUsuario ) ');
$sql->bindValue('codigo', $codigo);
$sql->bindValue('fecha', $fecha);
$sql->bindValue('hora', $hora);
$sql->bindValue('documentoUsuario', $doc);

try{
   $sql->execute(); //Ejecutar el sql
   $mensaje =  "Token Exitoso";
}
catch(Excepcion $e){
   $mensaje = $e->getMessage(); //Obtener el mensaje de error.
}
Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.

}

public function eliminarToken($codigo){

//Establecer la conexión a la base datos
$baseDatos = Conexion::Conectar();
//Preparar la sentencia sql
$sql = $baseDatos->prepare('DELETE FROM tokenverificacion WHERE documentoUsuario = :codigo');
$sql->bindValue('codigo', $codigo);


try{
   $sql->execute(); //Ejecutar el sql
   $mensaje =  "Token eliminado";
}
catch(Excepcion $e){
   $mensaje = $e->getMessage(); //Obtener el mensaje de error.
}
Conexion::Desconectar($baseDatos); //Desconectar de la base de datos.

}

    public function nuevaContrasena($p,$d){
    $mensaje = "";

    $md5Contrasena = md5($p);

    //Establecer la conexión a la base datos
    $baseDatos = Conexion::Conectar();
    //Preparar la sentencia sql
    $sql = $baseDatos->prepare('UPDATE usuario
    SET 
    contrasenaUsuario=:contrasenaUsuario
    WHERE docUsuario =:idUsuario 
    ');
    $sql->bindValue('contrasenaUsuario',$md5Contrasena);
    $sql->bindValue('idUsuario', $d);
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



    public function enviarToken($tok,$ema){

      $mensaje = "";
              $asunto = "RECUPERAR CONTRASEÑA | MY MUTIS";
      $msg = "<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <title>EJEMPLO</title>

  <!-- CSS only -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>

</head>
<body>
  

      <div class='container col-xxl-8 px-4 py-5'>
              <div class='row flex-lg-row-reverse align-items-center g-5 py-5'>
                <div class='col-10 col-sm-8 col-lg-6'>
                  <img src='https://fv9-6.failiem.lv/thumb_show.php?i=ymfhteyab&view' class='d-block mx-lg-auto img-fluid' width='700' height='500' loading='lazy'>
                </div>
                <div class='col-lg-6'>
                  <h1 class='display-5 fw-bold lh-1 mb-3'>Haz pedido un cambio de contraseña!</h1>
                  <p class='lead mb-4'>
                          La plataforma My Mutis es un sistema creado con la finalidad de mejorar los 
                          procesos de gestión de la información disciplinaria, institucional y académica. <br>
                          Recuerda que este código solo tiene vigencia de 1 hora.  
                          <br><b>Código de Verificación: </b>".$tok." <br>  </p>
                       
                </div>
              </div>
            </div>

    <!-- JavaScript Bundle with Popper -->
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>

</body>
</html>";        
              
              $email = $ema;
              $header = "From: directivos@mymutis.space". "\r\n";
              $header.= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $header.= "Reply-To: directivos@mymutis.space" . "\r\n";
              $header.= "X-Mailer: PHP/". phpversion();
              $mail =  mail($email,$asunto, $msg, $header);
             if ($mail) {
              $mensaje =  "Email Exitoso";
                
                  
           } 

  }

}

?>