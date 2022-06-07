<?php 
    require_once("POO/controlador/ControladorLogin.php");
    require_once("POO/modelo/usuario.php");
    require_once("POO/controlador/ControladorToken.php");

      $CLogin = new ControladorLogin();
      $User = new Usuario();
      $Ccorreo = new ControladorToken();

    if(isset($_REQUEST['botonToken2'])){
 
        if($Ccorreo->verificarToken($_REQUEST['cod'],$_REQUEST['user2'])){
            $docTemporales = md5($_REQUEST['user2']);
         //SE DEBE AÑADIR EL DOCUMENTO USUARIO
                  $Ccorreo->eliminarToken($_REQUEST['user2']);
                  header("Location:cambiarContrasena.php?encrDoc=".$docTemporales."&doc=".$_REQUEST['user2']."&verif=0");
        }
        else{
            echo '<body>
      <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>   
      </body>';
            ?>
            <script>
                                        Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Credenciales equivocadas',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        </script>
            <?php
        }
     
     }
else if($_GET['doc'] != "" && $_GET['verificacionTokenMyMutis'] == 1){
        $docTemporal = $_GET['doc'];
        date_default_timezone_set('America/Bogota');
        $hoy = date("Y-m-d");
        $hora = date("h:i",time());

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My mutis - Recuperar contraseña</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="css/mainLogin.css">
<!--===============================================================================================-->


</head>
<body style="background-color: #666666;">

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

             <!--FORMULARIO DE VERIFICAR TOKEN -->
            <form class="login100-form validate-form">
					<span class="login100-form-title p-b-40">
						My Mutis | Recuperar contraseña
					</span>
					<br>
                   
					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="user2" id="user2" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Documento</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="cod" id="cod" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Código de verificación</span>
					</div>

                    <br>
                    <div class="container">
                    <div class="row">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                <h4>Minutos: </h4>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                <h4 id="minutos">35</h4>
                        </div>

                    <div class="col-4 col-sm-4 col-md-4 col-lg-4">
                                <h4>Segundos: </h4>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                                <h4 id="segundos">35</h4>
                        </div>

                        </div>
						</div>

                

				<br>
                    <div class="container-login100-form-btn">
						<button class="login100-form-btn" name="botonToken2">
							Verificar código
						</button>
                        <br>
					</div>
                
                    <div class="container-login100-form-btn">
                    <a class="btn btn-dark" href="index.php" role="button" style="width:100%;">Iniciar sesión</a>
					</div>

				</form>

				<div class="login100-more" style="background-image: url('images/fondoContraOfi.png');">
				</div>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<!--===============================================================================================-->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<script>
var segundoInicio = 60;
var minutosInicio = 60;
var minutosEnSegundos = 3600;

function actualizar() {
    document.getElementById('segundos').innerHTML = segundoInicio;
    document.getElementById('minutos').innerHTML = minutosInicio;
    if (segundoInicio == 0) {
        // Cuenta regresiva ha finalizado
        segundoInicio = 60;
        minutosInicio = minutosInicio - 1;
        
        if(minutosEnSegundos == 0){
            //SE DEBE AÑADIR EL DOCUMENTO USUARIO
           <?php  //$Ccorreo->eliminarToken($docTemporal);  ?>
        }
        else{
            actualizar();
        }
        

     } else {
        //segundoInicio-=1;
        segundoInicio = segundoInicio -1;
        minutosEnSegundos = minutosEnSegundos -1;
        setTimeout (actualizar, 1E3);
     }
}

actualizar();

    </script>
<?php 
}
else{
    header("Location:recuperarContrasenaP1.php");
}
?>