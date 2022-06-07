<?php 
date_default_timezone_set('America/Bogota');
$hoy = date("Y-m-d");
$hora = date("h:i",time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My mutis</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/jpg" href="images/icons/mutis.jpg"/>
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
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-43">
						My mutis
					</span>
					<br>
					
					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="user" id="user">
						<span class="focus-input100"></span>
						<span class="label-input100">Usuario</span>
					</div>

					
	<select class="form-select" style="color: #a5a0ab;background: transparent;height: 75px;border: 1px solid #e6e6e6" name="rol" id="rol">
							<option selected value="0">Seleccione su Rol</option>
							<option value="1">Estudiante</option>
							<option value="2">Interno</option>
							<option value="3">Profesor</option>
							<option value="4">Secretario</option>
							<option value="5">Administrativo</option>
						  </select>
					
						  <br>
					
					
					<div class="wrap-input100 validate-input" data-validate="La contraseña es obligatoria">
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						
							<div>
							<?php
							
					if(isset($errorLogin)){
						echo $errorLogin;
					}

							?>
						</div>

						<div>
							<a href="recuperarContrasenaP1.php" class="txt1">
								Olvidaste tu contraseña?
							</a>
						</div>

						<div>
							<a href="terminos.php" class="txt1">
								Términos y Condiciones
							</a>
						</div>
					</div>
					<br>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Ingresar
						</button>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<a href="registro.php" class="btn btn-success" style="width:100%;">
								Crear cuenta
							</a>
					</div>
				</form>

				

				<div class="login100-more" style="background-image: url('images/fondoInicio1.png');">
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