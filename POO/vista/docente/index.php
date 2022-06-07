<?php 
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

    require_once("../../controlador/ControladorUsuario.php");
    require_once("../../controlador/ControladorGrupoxGradoxUsuario.php");

    $ControladorUsuario = new ControladorUsuario();
    $ControladorGrupoxGradoxUsuario = new ControladorGrupoxGradoxUsuario();

    $User = $ControladorUsuario->unUsuario($logeado);
    $directorGrupo = $ControladorGrupoxGradoxUsuario->listarGGU($User->getidUsuario());

    
    echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['btActualizar'])){

    if($User->getcorreoUsuarios()!=$_REQUEST['correo']){
        if(preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['correo']) && empty($_REQUEST['correo'])!=true ){
             $ControladorUsuario->actualizarUsuarioCorreo($User->getdocUsuarios(),$_REQUEST['correo']);
             ?>
             <script>
            Swal.fire({
                             title: 'ACTUALIZACIÓN CORRECTA',
                             icon: 'success',
                             showConfirmButton: false,
                             allowOutsideClick: false,
                             html:'Haz actualizado el correo! <br><br> ' +
                             '<a class="btn btn-success" href="index.php" role="button">Ok</a>'
                           });
                     </script>
             <?php

        }
        else{
            $validar = "Correo invalido";
        }
    }
    else{
            $validar = "No han habido cambios";
    }
    if($User->getcontrasenaUsuarios()!=$_REQUEST['contrasena']){
        if(empty($_REQUEST['contrasena'])!=true ){
             $ControladorUsuario->actualizarUsuarioContrasena($User->getdocUsuarios());
             ?>
             <script>
            Swal.fire({
                             title: 'ACTUALIZACIÓN CORRECTA',
                             icon: 'success',
                             showConfirmButton: false,
                             allowOutsideClick: false,
                             html:'Haz actualizado la contraseña! <br><br> ' +
                             '<a class="btn btn-success" href="index.php" role="button">Ok</a>'
                           });
                     </script>
             <?php
        }
        else{
            $validar = "Contraseña invalida";
        }
    }
    else{
            $validar = "No han habido cambios";
    }

}
else if(isset($_REQUEST['btActualizarImagen'])) {
    
   //extraer el nombre del documento
$doc = $ControladorUsuario->extraerNameDoc($logeado);

//documento
if($_FILES['imagen']['name'] != null){   

  $ControladorUsuario->actualizarUsuarioImagen($User->getdocUsuarios(),$_FILES['imagen']['name']);

  if($doc == null && $doc ==""){
  $ruta = "../../../images/fotosPerfil/";
  $nombrefinal = trim($_FILES['imagen']['name']);                   
  $upload = $ruta. $nombrefinal;  
  if(move_uploaded_file($_FILES['imagen']['tmp_name'],$upload)){
       ?>
             <script>
            Swal.fire({
                             title: 'ACTUALIZACIÓN CORRECTA',
                             icon: 'success',
                             showConfirmButton: false,
                             allowOutsideClick: false,
                             html:'Haz actualizado tu foto de perfil! <br><br> ' +
                             '<a class="btn btn-success" href="index.php" role="button">Ok</a>'
                           });
                     </script>
             <?php
              }                       
      }
      else{
          unlink('../../../images/fotosPerfil/'.$doc);
          $ruta = "../../../images/fotosPerfil/";
          $nombrefinal = trim($_FILES['imagen']['name']);                   
          $upload = $ruta. $nombrefinal;  
          if(move_uploaded_file($_FILES['imagen']['tmp_name'],$upload)){
           ?>
             <script>
            Swal.fire({
                             title: 'ACTUALIZACIÓN CORRECTA',
                             icon: 'success',
                             showConfirmButton: false,
                             allowOutsideClick: false,
                             html:'Haz actualizado tu foto de perfil! <br><br> ' +
                             '<a class="btn btn-success" href="index.php" role="button">Ok</a>'
                           });
                     </script>
             <?php
                      }                       
              }
  } 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:image" content="IMG URL">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My mutis | Perfil</title>

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link href="../../../vendor/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
<!--===============================================================================================-->
    <link href="../../../vendor/dasbord/style.css" rel="stylesheet">
<!--===============================================================================================-->
    <link href="../../../vendor/dasbord/default.css" id="theme" rel="stylesheet">

  
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== 
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis</p>
        </div>
    </div>-->

    <div id="main-wrapper">
     
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
      
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon --><b>
                           
                            <!-- Dark Logo icon -->
                            <img src="../../../images/logo.png" alt="homepage" class="dark-logo" style="width:70%;"/>
                           
                            
                        </b>
                        
                    </a>
                </div>
                
                <div class="navbar-collapse">

                <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                      
                    </ul>
                  
                    <ul class="navbar-nav my-sm-12">
                       
                       <li class="nav-item dropdown u-pro">
                       
                       <?php 
                            if($User->getimagenUsuario() == null &&  $User->getimagenUsuario() == ""){
                                $image = "vacio.png";
                            }
                            else{
                                $image = $User->getimagenUsuario();
                            }
                        ?>  
                       
                           <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"
                               id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <img
                               src="../../../images/fotosPerfil/<?php echo $image; ?>" alt="user"  height="40" /> 
                                 
                                   <span class="hidden-md-down"><?php echo $logeado; ?> | <?php echo $User->getidRolUsuario() ?></span> 
                               
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-sm-right" aria-labelledby="navbarDarkDropdownMenuLink">
                               <li><a class="dropdown-item" href="mymutis.php"><i class="fa fa-id-badge fa-lg"></i>&nbsp; Carnet</a></li>
                               <li><a class="dropdown-item" href="index.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
                              
                           </ul>
                          
                       </li>
                   </ul>
                </div>
            </nav>
        </header>
      
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav"> 
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class="fa fa-user-circle-o"></i><span class="hide-menu">Perfil</span></a>
                        </li>
<?php 
    if($directorGrupo == 1 || $directorGrupo == 2){

                            }
                            else{

                                ?>
                                <li> <a class="waves-effect waves-dark" href="examenes.php" aria-expanded="false"><i
                                            class="fa fa-users"></i><span class="hide-menu">Exámenes</span></a>
                                </li>
        
                                <?php
                            }
                        ?>

                        <li> <a class="waves-effect waves-dark" href="citas.php" aria-expanded="false"><i
                                    class="fa fa-envelope"></i><span class="hide-menu">Citas</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="redes.php" aria-expanded="false"><i
                                    class="fa fa-external-link"></i><span class="hide-menu">Redes Sociales</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="calendariodeEventos.php" aria-expanded="false"><i
                                    class="fa fa-calendar"></i><span class="hide-menu">Calendario de Eventos</span></a>
                        </li>

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-comments"></i>Preguntas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="preguntas.php"><i class="fa fa-question" aria-hidden="true"></i>&nbsp; Mis preguntas</a></li>
                            <li><a class="dropdown-item" href="preguntasResponder.php"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp; Responder Preguntas</a></li>
                        </ul>
                        </li>
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">
        
        <div class="container-fluid">
       
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Perfil</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Principal</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
               
            </div>
        
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            
                            <center class="mt-4"> <img src="../../../images/fotosPerfil/<?php echo $image; ?>" class="img-circle"
                                    width="150" alt="perfil" />
                                <h4 class="card-title mt-2"><?php echo $User->getnombresUsuarios() ?></h4>
                                <h6 class="card-subtitle"><?php echo $User->getidRolUsuario() ?></h6>
                                <h6 class="card-subtitle"><?php echo $User->getestadoUser() ?></h6>
                                <div class="row text-center justify-content-md-center">
                                   
                                </div>

                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                    <input type="file" class="form-control form-control-line" name="imagen" id="imagen" accept=".jpg, .jpeg, .png" REQUIRED>
                                    <br><br>
                                    <button type="submit" class="btn btn-warning" name="btActualizarImagen">Actualizar imagen</button>
                                    </form>

                            </center>
                        </div>
                    </div>
                </div>
              
                <!-- Column -->
                <!-- Column -->
                 
                <div class="col-lg-8 col-xlg-9 col-md-7">
                <br> 
                    <div class="card">
                        <!-- Tab panes -->
                        <div class="card-body">
                            <form class="form-horizontal form-material mx-2">
                                <div class="form-group">
                                    <label class="col-md-12">Usuario</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $User->getdocUsuarios() ?>"
                                            class="form-control form-control-line" name="documento" id="documento" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Nombres</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $User->getnombresUsuarios() ?>"
                                            class="form-control form-control-line" disabled
                                            id="example">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-md-12">Apellidos</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $User->getapellidosUsuarios() ?>"
                                            class="form-control form-control-line" disabled
                                            id="example2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-md-12">Correo</label>
                                    <div class="col-md-12">
                                        <input type="email"  value="<?php echo $User->getcorreoUsuarios() ?>"
                                            class="form-control form-control-line" 
                                            name="correo" id="correo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Contraseña</label>
                                    <div class="col-md-12">
                                        <input type="password" value="<?php echo $User->getcontrasenaUsuarios() ?>"
                                            class="form-control form-control-line" name="contrasena" id="contrasena">
                                    </div>
                                </div>
 
                                <p><?php 
                                    if(isset($validar)){
                                    echo $validar; }?></p>
                                
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success" name="btActualizar">Actualizar perfil</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
           
        </div>
       
                  
<footer class="footer"> © 2022 <a href="https://mymutis.space">mymutis.space</a> | <a href="terminos.php">Términos y Condiciones</a></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
    </div>
  
    </div>
  
    <script src="../../../vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../../vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Menu sidebar -->
    <script src="../../../vendor/dasbord/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../../vendor/dasbord/custom.min.js"></script>
 
</body>

</html>
<?php }
else{
    header("Location:../../../index.php");
}
?>