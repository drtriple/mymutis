<?php
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");
    $hora = date("h:i",time());

        require_once("POO/controlador/ControladorLogin.php");
        require_once("POO/modelo/usuario.php");
        require_once("POO/controlador/ControladorToken.php");

      $CLogin = new ControladorLogin();
      $User = new Usuario();
      $Ccorreo = new ControladorToken();

if(isset($_REQUEST['botonToken3'])){

    if(empty($_REQUEST['pass1'])!=true && empty($_REQUEST['pass2'])!=true){

        if($_REQUEST['pass1'] == $_REQUEST['pass2']){
            $Ccorreo->nuevaContrasena($_REQUEST['pass1'],$docTemporal);

            echo '<body>
            <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>   
            </body>';
      
            ?>
            <script>
           Swal.fire({
                            title: 'Haz cambiado tu contraseña!',
                            icon: 'success',
                            showConfirmButton: false,
                            html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                            '<a class="btn btn-success" href="index.php" role="button">Iniciar sesión</a> '
                          });
                    </script>
            <?php
        }
        else{
            echo "Contraseñas diferentes";
        }
    }
    else{
        echo "Campos vacíos";
    }
}
if($_GET['encrDoc'] != "" && $_GET['doc'] != "" && $_GET['verif'] == 0){
    $docTemporal = $_GET['doc'];
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
            <form class="login100-form validate-form" id="veriToke" method="POST" action="" >
					<span class="login100-form-title p-b-40">
						My Mutis | Recuperar contraseña
					</span>
					<br>
                   
					<div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="password" name="pass1" id="pass1" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Nueva contraseña</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Campos Inválidos">
						<input class="input100" type="password" name="pass2" id="pass2" required>
						<span class="focus-input100"></span>
						<span class="label-input100">Repita la contraseña</span>
					</div>

         

				<br>
                    <div class="container-login100-form-btn">
						<button class="login100-form-btn" name="botonToken3">
							Cambiar contrasena
						</button>
					</div>
                <br>

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
<?php 
}
else{
    header("Location:recuperarContrasenaP1.php");
}
?>