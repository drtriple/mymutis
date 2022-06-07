<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");

    require_once("../../modelo/eventos.php");
    require_once("../../controlador/ControladorEventos.php");
    require_once("../../modelo/usuario.php");
    require_once("../../controlador/ControladorUsuario.php");

    $even = new eventos();
    $ControladorEven = new ControladorEventos();
    $ControladorUsuario = new ControladorUsuario();
    $usuario = new usuario();

//
$User = $ControladorUsuario->unUsuario($logeado);

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['btnFiltrar'])){
    $a = $_REQUEST['estadoFiltrar'];
    $b = $_REQUEST['fechaFiltrar'];
    header("Location:calendariodeEventos.php?estadoFil=$a&fechaFil=$b");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My mutis | Calendario de Eventos</title>

    
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
    #idEventoActualizar{
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
            <p class="loader__label">My mutis | Calendario de Eventos</p>
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
															 <li><a class="dropdown-item" href="mymutis.php"><i class="fa fa-id-badge fa-lg"></i>&nbsp; Carnet</a></li>
															 <li><a class="dropdown-item" href="calendariodeEventos.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
															
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
                                    class="fa fa-user-circle-o"></i><span class="hide-menu">Perfil</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="examenes.php" aria-expanded="false"><i
                                    class="fa fa-users"></i><span class="hide-menu">Exámenes</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="citas.php" aria-expanded="false"><i
                                    class="fa fa-envelope"></i><span class="hide-menu">Citas</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="redes.php" aria-expanded="false"><i
                                    class="fa fa-external-link"></i><span class="hide-menu">Redes Sociales</span></a>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="preguntas.php" aria-expanded="false"><i
                                    class="fa fa-comments"></i><span class="hide-menu">Preguntas</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
                                    class="fa fa-calendar"></i><span class="hide-menu">Calendario de Eventos</span></a>
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
                        <h3 class="text-themecolor">Calendario de Eventos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Calendario de Eventos</li>
                        </ol>
                    </div>
                </div>
     
								<form class="row g-3">
                        <div class="col-6 col-sm-6 col-md-5 col-lg-5">
                        <label for="estadoFiltrar" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="estadoFiltrar" id="estadoFiltrar">                   
                                    <option selected value="0">Seleccione</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                    </select>
                                    </div>
                                    <div class="col-6 col-sm-6 col-md-5 col-lg-5">
                       
                            <label for="fechaFiltrar" class="form-label">Fecha de inicio</label>
                            <input type="date" id="fechaFiltrar" name="fechaFiltrar"
                                            
                                            min="2022-01-01" max="2025-12-31" class="form-control">
                                </div>
                                        <div class="col-12 col-sm-12 col-md-2 col-lg-2"><br>
                             <button class="btn btn-dark" style="width:100%;" name="btnFiltrar">Filtrar</button>
                        </div>   
                        </form>

												<br>
            
                 <div class="row">

								 <?php 

                            if($_GET['estadoFil'] != 0 && $_GET['fechaFil'] == ""){
                                $events = $ControladorEven->filtrarEventosAdminEstado($_GET['estadoFil']);
                            }
                            else if($_GET['fechaFil'] != "" && $_GET['estadoFil'] == 0){
                                $events = $ControladorEven->filtrarEventosAdminFecha('"'.$_GET['fechaFil'].'"');
                            }
                            else if($_GET['estadoFil'] != 0 && $_GET['fechaFil'] != ""){
                                $events = $ControladorEven->filtrarEventosAdminFechaEstado($_GET['estadoFil'],'"'.$_GET['fechaFil'].'"');
                            }
                            else{
                            //LISTAS
                                $events = $ControladorEven->listarEventosVarios();
                            }

								 
								 foreach($events as $e){

							 
								 ?>

                    <div class="col-12 col-sm-12 col-md-6 col-xl-3 text-center">
                   
								 <div class="card" style="width: 100%;">
										<img src="../../../images/banner.png" class="card-img-top" alt="...">
										<div class="card-body">
											<h3 class="card-title"><?php echo $e['nombreEvento']; ?> <br> <b>Fecha del evento: </b><?php echo $e['fechaInicio']; ?> <br> <b>Estado:</b> <?php echo $e['desEstado']; ?></h3>
											<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalVer<?php echo $e['idEvento']; ?>">Visualizar</button>
                                       
										</div>
									</div>
                                    <br> 
                        </div>
                        <br> 
								<!-- Modal VISUALIZAR-->
								<div class="modal fade " id="modalVer<?php echo $e['idEvento']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalVerLabel"><b>Fecha de inicio del evento:</b> 	<?php echo $e['fechaInicio']; ?> | <b>Jornada: </b><?php echo $e['jornada']; ?> </h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											Organizador: <?php echo $e['creador']; ?> | <b>Estado:</b> <?php echo $e['desEstado']; ?>
											<hr>
								 						<h3><?php echo $e['nombreEvento']; ?></h3>
														 <?php echo $e['informacionEvento']; ?>
											<hr>
								 	<b>Fecha de finalización del evento:</b> 	<?php echo $e['fechaFin']; ?> 
									 <hr>
								 			Documentos anexos: <br>
                                             <?php 
                                                    if($e['nombreDocumentoAnexo'] != null){    
                                                ?>
                                             <embed src="../../../documentosEventos/<?php echo $e['nombreDocumentoAnexo']; ?>" type="application/pdf" width="100%" height="600px" />
                                             <?php
                                             }
                                             else{
                                                 echo "Ningun documento accesible";
                                             }
                                             ?>
											</div>
											<div class="modal-footer text-muted">
										
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>
							     <!-- Modal fin-VISUALIZAR-->   
             
                                 <?php 
								
                            }
                            
                            ?>																							
                 </div>
                
            </div>
          
            

            <footer class="footer"> © 2022 <a href="https://mymutis.space">mymutis.space</a> | <a href="terminos.php">Términos y Condiciones</a></footer>
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