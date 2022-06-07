<?php 
require_once("POO/modelo/token.php");

class ControladorToken{
  
    public function token(Usuario $usu){
        $login = new token();
     
       return $login->token($usu);
    }

    public function verificarToken($c,$docu){
        $login = new token();
     
       return $login->verificarToken($c,$docu);
    }

    public function verificarTokenExistenciaUser($docu){
        $login = new token();
     
       return $login->verificarTokenExistenciaUser($docu);
    }

    public function crearToken($codigo,$fecha,$hora,$doc){
    

        $crudLogin = new token();
     $crudLogin->crearToken($codigo,$fecha,$hora,$doc);
    }

    public function eliminarToken($c){
        $login = new token();
         $login->eliminarToken($c);

    }

    public function nuevaContrasena($a,$b){
        $to = new token();
         $to->nuevaContrasena($a,$b);
    }

    public function enviarToken($tok,$ema){

        $modeloCorreo = new token();
        echo $modeloCorreo->enviarToken($tok,$ema);
    }

}

?>