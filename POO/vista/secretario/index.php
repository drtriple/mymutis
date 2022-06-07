<?php 
//error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

require_once("../../modelo/usuario.php");
require_once("../../controlador/ControladorGrupoxGradoxUsuario.php");
require_once("../../controlador/ControladorUsuario.php");
require_once("../../controlador/ControladorDocenteAsignatura.php");
require_once("../../controlador/ControladorHistorialLogin.php");
require_once("../../controlador/ControladorCorreo.php");
require_once("../../controlador/ControladorGrupoxGrado.php");

$User = new Usuario();
$ControladorUsuario = new ControladorUsuario();
$Controladorgg = new ControladorGrupoxGradoxUsuario();
$Controladorda = new ControladorDocenteAsignatura();
$Controladorhl = new ControladorHistorialLogin();
$ControladorCorreo = new ControladorCorreo();
$Controladorgxg = new ControladorGrupoxGrado();

//listas
$listargxg = $Controladorgxg->listarGG();
$Use = $ControladorUsuario->unUsuario($logeado);
$listarEstudiantesInactivo = $ControladorUsuario->listarEstudiantesInactivos();
$listarHistoria = $Controladorhl->listarHistorial();

echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCrear'])){
    

    if(empty($_REQUEST['user'])!=true && preg_match("/^[0-9]+$/", $_REQUEST['user']) && $_REQUEST['user'] >= 7 && 10 < $_REQUEST['user']){
        if(empty($_REQUEST['name'])!=true && preg_match("/^[a-zñA-ZÑ-áéíóúÁÉÍÓÚ ,.'-]+$/i", $_REQUEST['name']) && strlen($_REQUEST['name']) > 1){
            if(empty($_REQUEST['apellidos'])!=true && preg_match("/^[a-zñA-ZÑ-áéíóúÁÉÍÓÚ ,.'-]+$/i", $_REQUEST['apellidos']) && strlen($_REQUEST['apellidos']) > 1){
                if(empty($_REQUEST['email'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['email']) ){   
                    
                    switch ($_REQUEST['rol']) {
                        case 1:
                            if(empty($_REQUEST['emailAcudiente'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['emailAcudiente']) ){
                                
                                //crear Usuario
                                 //contrasena
                                    $pass = $_REQUEST['user']."mymutis";
   
                                $ControladorUsuario->crearUsuario($pass);                    
                                
                                $idUser = $ControladorUsuario->setUser($_REQUEST['user']);
                
                                //asinar grupo 
                                $Controladorgg->asignarGrupoUsuario($idUser,$_REQUEST['gxgEstudiante']);

                                //enviarCorreo
                                $rolEnviar = "Estudiante";
                                $ControladorCorreo->enviarCorreo($pass,$rolEnviar);
                                $ControladorCorreo->enviarCorreoAcudiente($_REQUEST['emailAcudiente'],$_REQUEST['user'],$pass);
                                ?>
                                     <script>
                                        Swal.fire({
                        position: 'bottom',
                        icon: 'success',
                        title: 'Usuario creado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                        });
                          </script>
                                <?php
                            }
                            else{
                                $validar= "Campo correo acudiente equivocado";
                            }
                            break;
                            case 2:
                                $pass = $_REQUEST['user']."mymutis";
                                $rolEnviar = "Interno";
                                //crear Usuario
                                $ControladorUsuario->crearUsuario($pass);
                                $ControladorCorreo->enviarCorreo($pass,$rolEnviar);
                                ?>
                                     <script>
                                        Swal.fire({
                                    position: 'bottom',
                                    icon: 'success',
                                    title: 'Usuario creado con éxito',
                                    showConfirmButton: false,
                                    timer: 1500
                                    });
                          </script>
                                <?php
                                break;
                                case 3:
                                    $pass = $_REQUEST['user']."mymutis";
                                    $rolEnviar = "Docente";
                                     //crear Usuario
                                    $ControladorUsuario->crearUsuario($pass);
                                     //obtener id de la cuenta creada
                                     $idUser = $ControladorUsuario->setUser($_REQUEST['user']);
                                     $ControladorCorreo->enviarCorreo($pass,$rolEnviar);
                                     
                                     //asignar materias
                                     if($_REQUEST['gxgDocente'] == 1 || $_REQUEST['gxgDocente'] == 2){
                                         $Controladorda->asignarAsignaturas($idUser,17);
                                     }
                                     else{
                                         $Controladorda->asignarAsignaturas($idUser,$_REQUEST['asignaturas']);
                                        if($_REQUEST['asignatura2']!=0){
                                            $Controladorda->asignarAsignaturas($idUser,$_REQUEST['asignatura2']);
                                        }
                                     }
                                    //asinar lider de grupo
                                    $Controladorgg->asignarGrupoUsuario($idUser,$_REQUEST['gxgDocente']);
                                    ?>
                                    <script>
                                       Swal.fire({
                       position: 'bottom',
                       icon: 'success',
                       title: 'Usuario creado con éxito',
                       showConfirmButton: false,
                       timer: 1500
                       });
                         </script>
                               <?php
                                    break;
                                    case 4:
                                        $pass = $_REQUEST['user']."mymutis";
                                        $rolEnviar = "Secretario";
                                     //crear Usuario
                                         $ControladorUsuario->crearUsuario($pass);
                                         $ControladorCorreo->enviarCorreo($pass,$rolEnviar);
                                         ?>
                                         <script>
                                            Swal.fire({
                            position: 'bottom',
                            icon: 'success',
                            title: 'Usuario creado con éxito',
                            showConfirmButton: false,
                            timer: 1500
                            });
                              </script>
                                    <?php
                                         break;
                                        case 5:
                                            $pass = $_REQUEST['user']."mymutis";
                                            $rolEnviar = "Administrativo";
                                           //crear Usuario
                                            $ControladorUsuario->crearUsuario($pass);
                                            $ControladorCorreo->enviarCorreo($pass,$rolEnviar);
                                            ?>
                                     <script>
                                        Swal.fire({
                        position: 'bottom',
                        icon: 'success',
                        title: 'Usuario creado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                        });
                          </script>
                                <?php
                                            break;
                    }

                }
                else{
                    $validar= "Campo correo equivocado";
                      }
            }
            else{
                $validar= "Campo apellidos equivocado";
                  }
        }
     else{
       $validar= "Campo nombres equivocado";
         }
    }
    else{
       $validar= "Campo documento usuario equivocado";
    }
}
else if(isset($_REQUEST['botonActualizar'])){

if($_REQUEST['estado']!=2){
    if($_REQUEST['gxg']!=0 || $_REQUEST['gxg']!=null){

        $ControladorUsuario->actualizarEstado($_REQUEST['idUser'],$_REQUEST['estado']);
        $Controladorgg->asignarGrupoUsuario($_REQUEST['idUser'],$_REQUEST['gxg']);   
        $ControladorCorreo->enviarCorreoActivacion($_REQUEST['nameModal'],$_REQUEST['emailModal']);
                ?>
                <script>
                Swal.fire({
        position: 'bottom',
        icon: 'success',
        title: 'USUARIO ACTIVADO CON ÉXITO - (RECUERDA RECARGAR LA PÁGINA)',
        showConfirmButton: false,
        timer: 1500
        });
        </script>
        <?php
    }
    else{
        ?>
                                     <script>
                                        Swal.fire({
                        position: 'bottom',
                        icon: 'error',
                        title: 'Campos Vacíos',
                        showConfirmButton: false,
                        timer: 1500
                        });
                          </script>
                                <?php
    }
        }
        else{
            ?>
            <script>
                    Swal.fire({
        position: 'bottom',
        icon: 'error',
        title: 'El usuario sigue desactivado',
        showConfirmButton: false,
        timer: 1500
        });
        </script>
       <?php

        }
}
else if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['btnBorrarHistorial'])){
    $Controladorhl->eliminarHistorial();
    ?>
    <script>
   Swal.fire({
                    title: 'ELIMINACIÓN EXITOSA:',
                    icon: 'success',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    html:'Haz eliminado los últimos 10 registros! <br><br> ' +
                    '<a class="btn btn-success" href="index.php" role="button">Ok</a> '
                  });
            </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My mutis</title>

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../../../images/icons/favicon.ico"/>
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
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis</p>
        </div>
    </div>

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
                            if($Use->getimagenUsuario() == null &&  $Use->getimagenUsuario() == ""){
                                $image = "vacio.png";
                            }
                            else{
                                $image = $Use->getimagenUsuario();
                            }
                        ?>  
                       
                           <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"
                               id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <img
                               src="../../../images/fotosPerfil/<?php echo $image; ?>" alt="user"  height="40" /> 
                                  
                                    <span class="hidden-md-down"><?php echo $logeado; ?> | <?php echo $Use->getidRolUsuario() ?></span> 
                                
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
                <nav class="sidebar-nav" >
                <ul id="sidebarnav"> 
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class="fa fa-tachometer"></i><span class="hide-menu">Principal</span></a>
                        </li>
                   
                        <li> <a class="waves-effect waves-dark" href="perfil.php" aria-expanded="false"><i
                                    class="fa fa-user-circle-o"></i><span class="hide-menu">Perfil</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="usuarios.php" aria-expanded="false"><i
                                    class="fa fa-users"></i><span class="hide-menu">Usuarios</span></a>
                        </li>
                       
                        <li> <a class="waves-effect waves-dark" href="calendariodeEventos.php" aria-expanded="false"><i
                                    class="fa fa-calendar"></i><span class="hide-menu">Calendario de Eventos</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="preguntas.php" aria-expanded="false"><i
                                    class="fa fa-comments"></i><span class="hide-menu">Preguntas</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="redes.php" aria-expanded="false"><i
                                    class="fa fa-external-link"></i><span class="hide-menu">Redes Sociales</span></a>
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
                    <div class="col-md-8 align-self-center">
                        <h3 class="text-themecolor">Principal</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Principal</li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">

                            <h2>Crear Usuario</h2>
                            
                                <form action="" method="post">
                                    <div class="row">

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="tipoDoc" class="form-label">Tipo documento:</label>
                                        <select class="form-select"  name="tipoDoc" id="tipoDoc">
                                          
                                            <option selected value="1">Registro Civil</option>
                                            <option value="2">Tarjeta de Identidad</option>
                                            <option value="3">Cédula de Ciudadanía</option>
                                            <option value="4">Cédula de extranjería</option>
                                            
                                          </select>
                                            </div>

                                            <div class="col-12 col-md-6 col-lg-6">
                                        <label for="user" class="form-label">Documento Usuario:</label>
                                        <input type="text"
                                          class="form-control" name="user" id="user" aria-describedby="helpId" placeholder="">
                                            </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-12 col-md-6 col-lg-6">
                                            <label for="name" class="form-label">Nombres:</label>
                                            <input type="text"
                                                  class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
                                                </div>

                                                    <div class="col-12 col-md-6 col-lg-6">
                                                <label for="apellidos" class="form-label">Apellidos:</label>
                                                <input type="text"
                                                          class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="">
                                                </div>


                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6">
                                    <label for="email" class="form-label">Correo:</label>
                                    <input type="email"
                                      class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                                        </div>

                                            <div class="col-12 col-md-6 col-lg-6">
                                        <label for="rol" class="form-label">Rol:</label>
                                        <select class="form-select"  name="rol" id="rol" onchange="roles()">
                                            <option selected value="1">Estudiante</option>
                                            <option value="2">Interno</option>
                                            <option value="3">Profesor</option>
                                            <option value="4">Secretario</option>
                                            <option value="5">Administrativo</option>
                                          </select>
                                            </div>

                                                
                                </div>
<br>
                              
                                <div class="row" id="estudiante">
                                        <div class="col-12 col-md-6 col-lg-6">
                                    <label for="emailAcudiente" class="form-label">Correo acudiente:</label>
                                    <input type="email"
                                      class="form-control" name="emailAcudiente" id="emailAcudiente" aria-describedby="helpId" placeholder="">
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-6">
                                <label for="gxgEstudiante" class="form-label">Grupo y grado:</label>
                                        <select class="form-select"  name="gxgEstudiante" id="gxgEstudiante">
                                        <option selected value="0">Seleccionar grado</option>
                                            <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                                </div>
                                            
                                </div>

                                <div class="row" id="docente">

                                <div class="col-12 col-md-4 col-lg-4">
                                <label for="gxgDocente" class="form-label">Director de grupo:</label>
                                        <select class="form-select"  name="gxgDocente" id="gxgDocente" onchange="directorGrupo()">
                                        <option selected value="0">Seleccionar grado</option>
                                            <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                                </div>
                                     

                                <div class="col-12 col-md-4 col-lg-4" id="ocultarGG1">
                                <label for="asignatura" class="form-label">Asignaturas:</label>
                                        <select class="form-select" id="asignaturas" name="asignaturas">
                                            <option selected value="1">Lengua Castellana</option>
                                            <option value="2">Lengua Extranjera</option>        
                                            <option value="3">Matemáticas</option>   
                                            <option value="4">Filosofía</option>   
                                            <option value="5">Educación</option>   
                                            <option value="6">Tecnología e Informatica</option>   
                                            <option value="7">Artística</option>   
                                            <option value="8">Ciencias Sociales</option>   
                                            <option value="9">Ciencias Naturales</option>   
                                            <option value="10">Política</option>   
                                            <option value="11">Química</option>   
                                            <option value="12">Media Técnica</option>   
                                            <option value="13">Biología</option>   
                                            <option value="14">Religión</option>   
                                            <option value="15">Ética</option>   
                                            <option value="16">Económia</option>     
                                           
                                          </select>
                                </div>

                                <div class="col-12 col-md-4 col-lg-4" id="ocultarGG2">
                                <label for="asignatura2" class="form-label">Asignaturas:</label>
                                        <select class="form-select" id="asignatura2" name="asignatura2">
                                            <option selected value="0">¿Otra asignatura?</option>
                                            <option value="1">Lengua Castellana</option>
                                            <option value="2">Lengua Extranjera</option>        
                                            <option value="3">Matemáticas</option>   
                                            <option value="4">Filosofía</option>   
                                            <option value="5">Educación</option>   
                                            <option value="6">Tecnología e Informatica</option>   
                                            <option value="7">Artística</option>   
                                            <option value="8">Ciencias Sociales</option>   
                                            <option value="9">Ciencias Naturales</option>   
                                            <option value="10">Política</option>   
                                            <option value="11">Química</option>   
                                            <option value="12">Media Técnica</option>   
                                            <option value="13">Biología</option>   
                                            <option value="14">Religión</option>   
                                            <option value="15">Ética</option>   
                                            <option value="16">Económia</option>     
                                           
                                          </select>
                                </div>

                                        
                                
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <p><?php 
                                    if(isset($validar)){
                                    echo $validar; }?></p>
                                    </div>
                                </div>

                                
                                    <div class="col-auto" style="margin: auto;width: 50%;padding: 10px;">
                                      <button type="submit" class="btn btn-success mb-3" name="botonCrear" style="width: 100%;">Crear</button>
                                    </div>
                                  </form>
                              
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                
                </div>

<br>
                <div class="row">
                
                <div class="col-lg-12 col-md-12">
                    <div class="card card-body mailbox table-responsive">
                        <h5 class="card-title">Verificaciones de cuentas estudiantiles</h5>
                      
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">VERIFICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
                            foreach($listarEstudiantesInactivo as $Usuario){ 
                            
                            ?>
                            <tr>
                            <th scope="row"><?php echo $Usuario['idUsuario']; ?></th>
                            <td><?php echo $Usuario['docUsuario']; ?></td>
                            <td><?php echo $Usuario['nombre']; ?> </td>
                            <td><?php echo $Usuario['correoUsuario']; ?></td>
                <td><center><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $Usuario['idUsuario']; ?>">Verificar</button></center></td>
                            </tr>
                          
                            
                        </tbody>


   <!-- Modal ESTUDIANTE-->
   <div class="modal fade" id="exampleModal<?php echo $Usuario['idUsuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="index.php?idUser=<?php echo $Usuario['idUsuario'];?>" method="POST">
                         <div class="row">

                           <div class="col-12 col-md-4 col-lg-4">
                           <label for="userModal" class="form-label">Documento:</label>
                          
                          <input type="text"
                            class="form-control" name="userModal" id="userModal" value="<?php echo $Usuario['docUsuario']; ?>" disabled>
                            </div>

                                <div class="col-12 col-md-4 col-lg-4">
                            <label for="nameModal" class="form-label">Nombres:</label>
                            <input type="text"
                                     class="form-control" name="nameModal" id="nameModal" aria-describedby="helpId" value="<?php echo $Usuario['nombre']; ?>">
                                </div>

                                <div class="col-12 col-md-4 col-lg-4">
                                <label for="emailModal" class="form-label">Correo:</label>
                                <input type="email"
                                class="form-control" name="emailModal" id="emailModal" aria-describedby="helpId" value="<?php echo $Usuario['correoUsuario']; ?>">
                                </div>
                                    </div>
                                  
                                        <br>
                                    <div class="row">

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="estado" class="form-label">Estado:</label>
                                        <select class="form-select"  name="estado" id="estado">
                                            <option selected value="2">Desactivado</option>
                                            <option value="1">Activado</option>            
                                          </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="gxg" class="form-label">Grupo y grado:</label>
                                        <select class="form-select"  name="gxg" id="gxg">
                                        <option selected value="0">Seleccionar grado</option>
                                            <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                                </div>
                                        </div>
                                        <br>

                                        <p><?php 
                                    if(isset($mensajeActualizar)){
                                    echo $mensajeActualizar; }?></p>

                                  
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-success" name="botonActualizar">Guardar cambios</button>
                                  
                                        </center>
                                    </div>
                                  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
  <!-- FIN Modal ESTUDIANTE-->

  <?php
                    }
                ?>
                        </table>

                    </div>
                </div>
            
             
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
    <script src="../../../js/main.js"></script>
 
   
</body>
</html>
<?php }
else{
    header("Location:../../../index.php");
}
?>