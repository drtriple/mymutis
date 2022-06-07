<?php 
//error_reporting(0);
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d");
$hora = date("h:i",time());

require_once("POO/controlador/ControladorLogin.php");
require_once("POO/modelo/usuario.php");
require_once("POO/controlador/ControladorToken.php");


$CLogin = new ControladorLogin();
      $User = new Usuario();
      $Ccorreo = new ControladorToken();
	  if(isset($_REQUEST['botonToken1'])){

		$docEncrip = $_POST['user'];

		$User->setdocUsuarios($_POST['user']);
		$User->setcorreoUsuarios($_POST['correo']);
	
		//validar existencia del usuario
		if($Ccorreo->token($User)){ 
		 
			//crear token 
			$c = rand(1000,9999);
			$Ccorreo->crearToken($c,$hoy,$hora,$_POST['user']);
			$Ccorreo->enviarToken($c,$_POST['correo']);
			header("Location:verificarToken.php?doc=".$docEncrip."&verificacionTokenMyMutis=1");
		
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
                <!---FORMULARIO UNO--->
				<form class="login100-form validate-form" method="POST" action="recuperarContrasenaP1.php" >
					<span class="login100-form-title p-b-40">
						My Mutis | Recuperar contraseña
					</span>
					<br>

					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="user" id="user" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Documento</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="email" name="correo" id="correo" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Correo</span>
					</div>

				<br>
				<div class="row">
							<div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="container-login100-form-btn">						
							<button class="login100-form-btn" name="botonToken1" style="width:100%;">
							Obtener código
						</button>
					</div>
					<br>
				</div>
				
				<div class="col-12 col-sm-6 col-md-6 col-lg-6">
				<a class="btn btn-dark" href="index.php" role="button" style="width:100%;">Iniciar sesión</a>				
					</div></div>

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