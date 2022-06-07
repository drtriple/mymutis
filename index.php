<?php
  	require_once("POO/controlador/ControladorLogin.php");
    require_once("POO/modelo/usuario.php");
    //require_once("../POO/controlador/ControladorHistorialLogin.php");

      $CLogin = new ControladorLogin();
      $User = new Usuario();
      //$CHistorial = new ControladorHistorialLogin();

      if(isset($_SESSION['user'])){
       
        $User->setdocUsuarios($Clogin->getVariableSesion());
        $us = $CLogin->setUser($Clogin->getVariableSesion());
        $rol = $us->getidRolUsuario();
        switch($rol){

          case 1:
            // header("Location:https://mymutis.000webhostapp.com/POO/vista/estudiante/");
             header("Location:POO/vista/estudiante/");
             break;
           case 2:
           //  header("Location:https://mymutis.000webhostapp.com/POO/vista/interno/");
             header("Location:POO/vista/interno/");
               break;
           case 3:
            // header("Location:https://mymutis.000webhostapp.com/POO/vista/docente/");
             header("Location:POO/vista/docente/");
               break;
           case 4:
             //header("Location:https://mymutis.000webhostapp.com/POO/vista/secretario/");
             header("Location:POO/vista/secretario/");
               break;
           case 5:
             //header("Location:https://mymutis.000webhostapp.com/POO/vista/administrativo/");
             header("Location:POO/vista/administrativo/");        
               break;

        }

		//echo "HAY SESION";
    //$CLogin->cerrarSesion();
  }
  else if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['rol'])) {
    
        $User->setdocUsuarios($_POST['user']);
        $User->setcontrasenaUsuarios($_POST['pass']);
        $User->setidRolUsuario($_POST['rol']);
        

        if($CLogin->existenciaUsuario($User)){ 

            $u = $CLogin->setUser($_POST['user']);

            $estado = $u->getestadoUser();
            $rol = $u->getidRolUsuario();

            if($estado == 2){
              header("Location:stop.php");
              //header("Location:https://mymutis.000webhostapp.com/stop.php");
            }
            else{
              session_start();
              $CLogin->setVariableSesion($_POST['user']);

              date_default_timezone_set('America/Bogota');
              $hoy = date("Y-m-d");
              $hora = date("h:i",time());
              $horario = date("a",time());
              $CLogin->registrarIngreso($hoy,$hora,$User->getdocUsuarios(),$horario);
              echo '<meta name="viewport" content="width=device-width, initial-scale=1"><body>  
              <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
              </body>';
                      
                switch($rol){
                 
                  case 1:
                  ?>
                  <script>
                 Swal.fire({
                                  title: 'BIENVENIDO A MY MUTIS: <?php echo $_POST['user'];  ?>',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  allowOutsideClick: false,
                                  html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                                  '<a class="btn btn-success" href="POO/vista/estudiante/" role="button">Ingresar</a> '
                                });
                          </script>
                  <?php
                    break;
                  case 2:
                  ?>
                  <script>
                 Swal.fire({
                                  title: 'BIENVENIDO A MY MUTIS: <?php echo $_POST['user'];  ?>',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  allowOutsideClick: false,
                                  html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                                  '<a class="btn btn-success" href="POO/vista/interno/" role="button">Ingresar</a> '
                                });
                          </script>
                  <?php
                  //  header("Location:https://mymutis.000webhostapp.com/POO/vista/interno/");
                      break;
                  case 3:
                  ?>
                  <script>
                 Swal.fire({
                                  title: 'BIENVENIDO A MY MUTIS: <?php echo $_POST['user'];  ?>',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  allowOutsideClick: false,
                                  html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                                  '<a class="btn btn-success" href="POO/vista/docente/" role="button">Ingresar</a> '
                                });
                          </script>
                  <?php
                   // header("Location:https://mymutis.000webhostapp.com/POO/vista/docente/");
                      break;
                  case 4:
                  ?>
                  <script>
                 Swal.fire({
                                  title: 'BIENVENIDO A MY MUTIS: <?php echo $_POST['user'];  ?>',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  allowOutsideClick: false,
                                  html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                                  '<a class="btn btn-success" href="POO/vista/secretario/" role="button">Ingresar</a> '
                                });
                          </script>
                  <?php
                      break;
                  case 5:
                  ?>
                  <script>
                 Swal.fire({
                                  title: 'BIENVENIDO A MY MUTIS: <?php echo $_POST['user'];  ?>',
                                  icon: 'success',
                                  showConfirmButton: false,
                                  allowOutsideClick: false,
                                  html:'Esperamos que disfrutes de este espacio! <br><br> ' +
                                  '<a class="btn btn-success" href="POO/vista/administrativo/" role="button">Ingresar</a> '
                                });
                          </script>
                  <?php      
                      break;

                }

            }

        }
        else{
          echo '<body>  
              <script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
              </body>';
          ?>
          <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Usuario, Contraseña y/o Rol incorrectos'
      })
    </script>
          <?php
          include_once("POO/vista/login.php");
        }

  }
  else{
   	include_once("POO/vista/login.php");
  }
    ?>   