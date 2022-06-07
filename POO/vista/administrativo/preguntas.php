<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");

    require_once("../../controlador/controladorPregunta.php");
    require_once("../../controlador/ControladorUsuario.php");

    $ControladorPregunta = new controladorPregunta();
    $ControladorUsuario = new ControladorUsuario();

//extraer ID y nombre usuario
$User = $ControladorUsuario->unUsuario($logeado);
echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['botonResponder'])){

    if(empty($_REQUEST['respuestaPregunta'])!=true){
        $ControladorPregunta->responderPregunta($User->getidUsuario(),$hoy);
        ?>
            <script>
            Swal.fire({
                    title: 'Se respondió exitosamente la pregunta',
                    icon: 'success',
                    showConfirmButton: false,
                    html:'<a class="btn btn-success" href="preguntas.php" role="button">Aceptar</a> '
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
else if(isset($_REQUEST['botonEliminarPregunta'])){
    $ControladorPregunta->eliminarPregunta($_GET['idPre']);
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My mutis | Preguntas</title>

    
<!--===============================================================================================-->	
    <link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/>
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
    #ocultarID{
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
            <p class="loader__label">My mutis | Preguntas</p>
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
                        <li> <a class="waves-effect waves-dark" href="grupo.php" aria-expanded="false"><i
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
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
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
                        <h3 class="text-themecolor">Preguntas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Preguntas</li>
                        </ol>
                    </div>
                </div>
            
                 <div class="row">

         
                 <div class="col-lg-12 col-md-12">
                    <div class="card card-body mailbox table-responsive">

                    <form class="row g-3">
                        <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                        <label for="estadoFiltrar" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="estadoFiltrar" id="estadoFiltrar">                   
                                    <option selected value="0">Seleccione</option>
                                    <option value="1">Resueltos</option>
                                    <option value="2">Sin Responder</option>
                                    </select>
                                    </div>
                                    <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                       
                            <label for="fechaFiltrar" class="form-label">Fecha</label>
                            <input type="date" id="fechaFiltrar" name="fechaFiltrar"
                                            
                                            min="2022-01-01" max="2025-12-31" class="form-control">
                                </div>
                                        <div class="col-12 col-sm-2 col-md-2 col-lg-2"><br>
                             <button class="btn btn-dark" style="width:100%;" name="btnFiltrar">Filtrar</button>
                        </div>   
                        </form>
                

                        <br>
                        <?php 
                        echo "<h3>".$mensajeResponder."</h3>";

                    if($_GET['estadoFiltrar'] != 0 && $_GET['fechaFiltrar'] == ""){
                        $listarPreg = $ControladorPregunta->filtrarPreguntaEstado($_GET['estadoFiltrar'],$User->getidUsuario());
                    }
                    else if($_GET['estadoFiltrar'] == 0 && $_GET['fechaFiltrar'] != ""){
                        $listarPreg = $ControladorPregunta->filtrarPreguntaFecha('"'.$_GET['fechaFiltrar'].'"',$User->getidUsuario());
                    }
                    else if($_GET['estadoFiltrar'] != 0 && $_GET['fechaFiltrar'] != ""){
                        $listarPreg = $ControladorPregunta->filtrarPreguntaEstadoFecha($_GET['estadoFiltrar'],'"'.$_GET['fechaFiltrar'].'"',$User->getidUsuario());
                    }
                    else{
                    //LISTAS4
                    $listarPreg = $ControladorPregunta->listarPreguntas($User->getidUsuario());
                    }


                    foreach ($listarPreg as $l){


                    ?>
                        <div class="card" style="width: 100%;">
                        <div class="card-body">

                        <?php                
                            if($l['idEstadoPregunta'] == 2){
                                ?>                             
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $l['idPregunta']; ?>"> Responder Pregunta</button>                             
                               <?php
                            }
                            else{
                                ?>
                              
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $l['idPregunta']; ?>"> Eliminar pregunta </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar<?php echo $l['idPregunta']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">ELIMINAR PREGUNTA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           ¿Estas seguro que deseas eliminar la pregunta? (La pregunta será borrada totalmente).
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a class="btn btn-danger" href="preguntas.php?botonEliminarPregunta&idPre=<?php echo $l['idPregunta']; ?>">Eliminar</a>
                        </div>
                        </div>
                    </div>
                    </div>

                                <?php   
                            }
                            ?>
                                <br><br>
                            <?php $idResp = $l['idPregunta']; ?>
                            <h5 class="card-title" style="text-align:center"><div class="row"><div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><b>Pregunta por:</b> <?php echo $l['Creador']; ?> </div><div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><b>Fecha Pregunta:</b> <?php echo $l['FechaPregunta']; ?></div><div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><b>Estado:</b> <?php echo $l['descPregunta']; ?></div></div></h5>
                            
                            <p class="card-text"><b>Pregunta:</b> <?php echo $l['DesPregunta']; ?></p>
                                  
                            <h5 class="card-title" style="text-align:center"><div class="row"><div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"><b>Respuesta por:</b> <?php echo $l['responder']; ?> </div><div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"><b>Fecha de Respuesta:</b> <?php echo $l['FechaRespuestaPregunta']; ?></div></div></h5>
                            
                            <p class="card-text"><b>Respuesta:</b> <?php echo $l['RespuestaPregunta']; ?></p>
                    
                        </div>
                        </div> 
                        <br>
                
                    
                    <!-------MODALLLLLLL RESPONDER -->
<div class="modal fade" id="exampleModal<?php echo $l['idPregunta']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Responder pregunta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
                         <div class="row">

                         <div class="col-12 col-md-6 col-lg-6" id="ocultarID">
                                <input type="text"
                                        class="form-control" name="idCitaResponder" id="idCitaResponder" aria-describedby="helpId" value="<?php echo $l['idPregunta']; ?>">                    
                            </div>


                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="idCitador" class="form-label">Usuario que pregunta:</label>
                                <input type="text"
                                        class="form-control" name="idCitador" id="idCitador" aria-describedby="helpId" value="<?php echo $l['Creador']; ?>" disabled>                    
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <label for="FechaCita" class="form-label">Fecha de respuesta:</label>
                                <input type="date"
                                class="form-control" name="FechaCita" id="FechaCita" aria-describedby="helpId" value="<?php echo $hoy?>" disabled>
                            </div>

                                </div>
            
                                    <br>
                                    <div class="col-12 col-md-12 col-lg-12">
                                    <label for="idEstadoCita" class="form-label">Pregunta:</label>
                                    <p class="card-text"><?php echo $l['DesPregunta']; ?></p>
                                    </div>
                                  
                                        <br>
                                    <div class="row">

                               <div class="col-12 col-md-12 col-lg-12">
                               <label for="respuestaPregunta" class="form-label">Respuesta :</label>
                               <textarea
                                      class="form-control" name="respuestaPregunta" id="respuestaPregunta" aria-describedby="helpId" placeholder=""></textarea>

                                            </div>

                                        </div>
                        
                                        <br>

                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-dark" name="botonResponder">Responder</button>
                                  
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
                     

                    <?php 
//fin del foreach
                    }
                    ?>  


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
 
</body>
</html>
<?php }
else{
    header("Location:../../../index.php");
}
?>