<?php 
require_once("POO/controlador/ControladorLogin.php");

$ControladorLogin = new ControladorLogin();

echo '<body>
      <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>   
      </body>';

if(isset($_REQUEST['botonRegistrar'])){ //Verificar si una variable existe en php
	
	if($_REQUEST['tipoDocumento']!=0){
		if(empty($_REQUEST['user'])!=true && preg_match("/^[0-9]+$/", $_REQUEST['user']) && $_REQUEST['user'] >= 7 && 10 < $_REQUEST['user']){
			if(empty($_REQUEST['nombres'])!=true && preg_match("/^[a-zñA-ZÑ-áéíóúÁÉÍÓÚ ,.'-]+$/i", $_REQUEST['name']) && strlen($_REQUEST['name']) > 1){
				if(empty($_REQUEST['apellidos'])!=true && preg_match("/^[a-zñA-ZÑ-áéíóúÁÉÍÓÚ ,.'-]+$/i", $_REQUEST['apellidos']) && strlen($_REQUEST['apellidos']) > 1){
					if(empty($_REQUEST['correo'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['correo']) ){
						if(empty($_REQUEST['correoAcudiente'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['correoAcudiente']) && $_REQUEST['correoAcudiente'] != $_REQUEST['correo']){
							if(empty($_REQUEST['pass'])!=true ){
								if($_FILES['inputGroupFile01']['name'] != null){   
						
									$ruta = "images/fotosPerfil/";
									$nombrefinal = trim($_FILES['inputGroupFile01']['name']);                   
									$upload = $ruta. $nombrefinal;  
									if(move_uploaded_file($_FILES['inputGroupFile01']['tmp_name'],$upload)){
										$ControladorLogin->registrarUsuario($_FILES['inputGroupFile01']['name']);
										$ControladorLogin->enviarCorreoEstudiante($_REQUEST['user'],$_REQUEST['correo']);
										$ControladorLogin->enviarCorreoAcudiente($_REQUEST['user'],$_REQUEST['pass'],$_REQUEST['correoAcudiente']);
										?>
										<script>
									   Swal.fire({
														title: 'HAZ CREADO TU CUENTA EN MY MUTIS!',
														icon: 'success',
														showConfirmButton: false,
														html:'Esperamos que disfrutes de este espacio! <br><br> ' +
														'<a class="btn btn-success" href="index.php" role="button">Iniciar sesión</a> '
													  });
												</script>
										<?php
												}                       
																				
									} 
							else{	
								$ControladorLogin->registrarUsuario($_FILES['inputGroupFile01']['name']);
								$ControladorLogin->enviarCorreoEstudiante($_REQUEST['user'],$_REQUEST['pass'],$_REQUEST['correo']);
								$ControladorLogin->enviarCorreoAcudiente($_REQUEST['user'],$_REQUEST['pass'],$_REQUEST['correoAcudiente']);
								?>
								<script>
							   Swal.fire({
												title: 'HAZ CREADO TU CUENTA EN MY MUTIS!',
												icon: 'success',
												showConfirmButton: false,
												html:'Esperamos que disfrutes de este espacio! <br><br> ' +
												'<a class="btn btn-success" href="index.php" role="button">Iniciar sesión</a> '
											  });
										</script>
								<?php
								}
							}
							else{
								$errorRegistro = "Campo de contraseña vacío";
							}

						}
						else{
							$errorRegistro = "Campo de correo Acudiente equivocado";
						}

					}
					else{
						$errorRegistro = "Campo de correo equivocado";
					}

				}
				else{
					$errorRegistro = "Campo de apellidos equivocado";
				}

			}
			else{
				$errorRegistro = "Campo de nombres equivocado";
			}
		}
		else{
			$errorRegistro = "Campo de documento equivocado";
		}
	}
	else{
		$errorRegistro = "Seleccione un tipo de documento";
	}
   // 
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My mutis | CREAR CUENTA</title>
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
				<form class="login100-form validate-form" method="POST" action="registro.php" enctype="multipart/form-data">
					<span class="login100-form-title p-b-43">
						My Mutis
					</span>
					<br>
					
                    <select class="form-select" style="color: #a5a0ab;background: transparent;height: 75px;border: 1px solid #e6e6e6" name="tipoDocumento" id="tipoDocumento">
                    <option selected value="0">Tipo documento:</option>
                    <option  value="1">Registro Civil</option>
                    <option  value="2">Tarjeta de Identidad</option>
                    <option  value="3">Cédula de Ciudadanía</option>
                    <option  value="4">Cédula de extranjería</option>
						  </select>

                          <br>

					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="user" id="user">
						<span class="focus-input100"></span>
						<span class="label-input100">Documento</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="nombres" id="nombres">
						<span class="focus-input100"></span>
						<span class="label-input100">Nombres</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="text" name="apellidos" id="apellidos">
						<span class="focus-input100"></span>
						<span class="label-input100">Apellidos</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="email" name="correo" id="correo">
						<span class="focus-input100"></span>
						<span class="label-input100">Correo</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="email" name="correoAcudiente" id="correoAcudiente">
						<span class="focus-input100"></span>
						<span class="label-input100">Correo Acudiente</span>
					</div>

					
	<select class="form-select" style="color: #a5a0ab;background: transparent;height: 75px;border: 1px solid #e6e6e6" name="rol" id="rol">
							<option selected value="1">Estudiante</option>
			
						  </select>
					
						  <br>

						  <div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupFile01">Imagen</label>
						<input type="file" class="form-control" id="inputGroupFile01" name="inputGroupFile01" accept=".jpg, .jpeg, .png">
						</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="La contraseña es obligatoria">
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						
							<div>
							<?php
							
					if(isset($errorRegistro)){
						echo $errorRegistro;
					}

							?>
						</div>

						<div>
							<a href="recuperarContrasenaP1.php" class="txt1">
								Olvidadaste tu contraseña?
							</a>
						</div>

						<div>
							<a href="index.php" class="txt1">
								Iniciar sesión
							</a>
						</div>
					</div>
					<br>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="botonRegistrar">
							Crear cuenta
						</button>
					</div>
					<br>
	
				</form>

				<div class="login100-more" style="background-image: url('images/fondoLoginOfi.png');">
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