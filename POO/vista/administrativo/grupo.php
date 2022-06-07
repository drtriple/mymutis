<?php 
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");

    require_once("../../controlador/ControladorGrupoxGrado.php");
    require_once("../../controlador/ControladorUsuario.php");
    
    $ControladorUsuario = new ControladorUsuario();
    $User = $ControladorUsuario->unUsuario($logeado);
    $ControladorGrupoxGrado = new ControladorGrupoxGrado();
  
    $listarG = $ControladorGrupoxGrado->listarGG();

    echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body> 
    <script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>  
    </body>';

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['btnCrearGG'])){
        if(empty($_REQUEST['gradoCrear']) != true){
            if(empty($_REQUEST['grupoCrear']) != true){
                $ControladorGrupoxGrado->crearGG();
                ?>
                        <script>
                        Swal.fire({
                                title: 'Se creó exitosamente el grupo',
                                icon: 'success',
                                showConfirmButton: false,
                                html:'<a class="btn btn-success" href="../../../POO/vista/administrativo/grupo.php" role="button">Aceptar</a> '
                                });
                        </script>
                <?php
            }
            else{
                ?>
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Campos vacíos'
                    })
                    </script>
                <?php
            }
        }
        else{
            ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Campos vacíos'
                })
                </script>
            <?php
        }
}
else if(isset($_REQUEST['btnActualizarGG'])){
    if(empty($_REQUEST['gradoActualizar']) != true){
        if(empty($_REQUEST['grupoActualizar']) != true){
            $ControladorGrupoxGrado->actualizarGG($_REQUEST['gradoActualizar'],$_REQUEST['grupoActualizar'],$_REQUEST['idGG']);
            ?>
                <script>
                Swal.fire({
                        title: 'Se actualizó exitosamente el grupo',
                        icon: 'success',
                        showConfirmButton: false,
                        html:'<a class="btn btn-success" href="../../../POO/vista/administrativo/grupo.php" role="button">Aceptar</a> '
                        });
                </script>
            <?php
        }
        else{
            ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Campos vacíos'
                })
                </script>
            <?php
        }
    }
    ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Campos vacíos'
        })
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
    
    <title>My mutis | Grupo</title>

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
   <!--==================================CALENDARIO=============================================================-->
  
<style>
    #idGG{
        display: none;
    }
    </style>
</head>
<body class="fix-header fix-sidebar card-no-border">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis | Grupo</p>
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
                                  <li><a class="dropdown-item" href="perfil.php"><i class="fa fa-user-circle-o fa-lg"></i>&nbsp; Perfil</a></li>
                                  <li><a class="dropdown-item" href="mymutis.php"><i class="fa fa-id-badge fa-lg"></i>&nbsp; Carnet</a></li>
                               <li><a class="dropdown-item" href="preguntas.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
                              
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
                    <li> <a class="waves-effect waves-dark" href="index.php" aria-expanded="false"><i
                                    class="fa fa-tachometer"></i><span class="hide-menu">Principal</span></a>
                        </li>
               
                        <li> <a class="waves-effect waves-dark" href="usuarios.php" aria-expanded="false"><i
                                    class="fa fa-users"></i><span class="hide-menu">Usuarios</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class="fa fa-server"></i><span class="hide-menu">Grupos</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="roles.php" aria-expanded="false"><i
                                    class="fa fa-address-card"></i><span class="hide-menu">Roles</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="examenes.php" aria-expanded="false"><i
                                    class="fa fa-file-text"></i><span class="hide-menu">Exámenes</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="citas.php" aria-expanded="false"><i
                                    class="fa fa-envelope"></i><span class="hide-menu">Citas</span></a>
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
                        <h3 class="text-themecolor">Grupo y Grado</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Grupo y Grado</li>
                        </ol>
                    </div>
                </div>
            
                 <div class="row">        
                 <div class="col-lg-12 col-md-12">
                    <div class="card card-body mailbox table-responsive">

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear grado y grupo</button>
                    <br><br>

                    <!-- Modal CREAR-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CREAR GRADO Y GRUPO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="grupo.php" method="post">

                         <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="gradoCrear" class="form-label">Grado:</label>
                            <input type="text"
                                     class="form-control" name="gradoCrear" id="gradoCrear" aria-describedby="helpId">
                                </div>
                        </div>
                                <br>
                                <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="grupoCrear" class="form-label">Grupo:</label>
                            <input type="text"
                                     class="form-control" name="grupoCrear" id="grupoCrear" aria-describedby="helpId" >
                                </div>
                        </div>
             
                        <p><?php 
                                    if(isset($mensajeCrear)){
                                    echo $mensajeCrear; }?></p>

                                        <br>
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-danger" style="width:100%;" name="btnCrearGG">Crear</button>
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
                    <!-- Modal FIN CREAR-->

                    <table class="table table-bordered" id="tablaVarios">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Actualización</th>
                            </tr>
                        </thead>                      
                        <tbody>
                        <?php 
                        foreach($listarG as $l){

                        ?>
                            <tr>
                            <th scope="row"><?php echo $l['idGradoxGrupo']; ?></th>
                            <td><?php echo $l['descGrado']; ?></td>
                            <td><?php echo $l['descGrupo']; ?></td>
                            <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#actualizarModal<?php echo $l['idGradoxGrupo']; ?>">Actualizar</button></td>
                            </tr>    
                            
                            <!-- Modal ACTUALIZAR-->
                <div class="modal fade" id="actualizarModal<?php echo $l['idGradoxGrupo']; ?>" tabindex="-1" aria-labelledby="actualizarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actualizarModalLabel">ACTUALIZAR GRADO Y GRUPO</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="grupo.php" method="post">

                    <input type="text"
                                     class="form-control" name="idGG" id="idGG" aria-describedby="helpId" value="<?php echo $l['idGradoxGrupo']; ?>">

                         <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="gradoActualizar" class="form-label">Grado:</label>
                            <input type="text"
                                     class="form-control" name="gradoActualizar" id="gradoActualizar" aria-describedby="helpId" value="<?php echo $l['descGrado']; ?>">
                                </div>
                        </div>
                                <br>
                                <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="grupoActualizar" class="form-label">Grupo:</label>
                            <input type="text"
                                     class="form-control" name="grupoActualizar" id="grupoActualizar" aria-describedby="helpId" value="<?php echo $l['descGrupo']; ?>">
                                </div>
                        </div>
             
                        <p><?php 
                                    if(isset($mensajeActualizar)){
                                    echo $mensajeActualizar; }?></p>

                                        <br>
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-danger" style="width:100%;" name="btnActualizarGG">Actualizar</button>
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
                    <!-- Modal FIN ACTUALIZAR-->
                            
                            <?php                
                             }
                        ?>                      
                        </tbody>                      
                        </table>
                
                    </div>
            </div>
        </div>  
 </div> 
 <footer class="footer"> © 2022 <a href="https://mymutis.com">mymutis.com</a> | <a href="terminos.php">Términos y Condiciones</a></footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

    <script>

$(document).ready(function() {
    $('#tablaVarios').DataTable({
    "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
    });
    });
    </script>
</body>
</html>
<?php }
else{
    header("Location:../../../index.php");
}
?>