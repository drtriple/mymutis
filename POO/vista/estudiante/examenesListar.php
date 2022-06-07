<?php 
//error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

	require_once("../../modelo/examen.php");
    require_once("../../controlador/ControladorExamen.php");
    require_once("../../controlador/ControladorUsuario.php");

    $ControladorUsuario = new ControladorUsuario();
    $User = $ControladorUsuario->unUsuario($logeado);
    $exam = new examen();
    $ControladorExam = new ControladorExamen();    


    $gxg = $ControladorExam->listarGG($logeado);
        foreach($gxg as $cit){
                    $Gxg= $cit['idGG'];
        }
    $listar = $ControladorExam->listarExamenE($Gxg);
    #$listar1 = $ControladorExam->listarAsignaturasA();

    foreach ($listar as $examB) {
        $asignatura = $examB['nombreAsignatura'] ;
    }

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>My mutis | Exámenes</title>

    
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
  
            <!-- FullCalendar -->
            <link href="../../../css/fullcalendar.css" rel="stylesheet" />



</head>

<body class="fix-header fix-sidebar card-no-border">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis | Exámenes</p>
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
											<li><a class="dropdown-item" href="examenes.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
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

                        <li> <a class="waves-effect waves-dark" href="calendariodeEventos.php" aria-expanded="false"><i
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
                    
                        <h3 class="text-themecolor">Exámenes | <?php echo $asignatura ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Exámenes</li>   
                                                         
                        </ol>
                    </div>
                </div>
                <a class="btn btn-success" href="examenes.php" style="width:100%;">Atrás</a>
                                <!--   <input type="hidden" name="idAsigna" value="<?php #echo $_GET['idAsigna']?>">-->
<br><br>
                    <?php  foreach ($listar as $examA) {
                        $asignatura = $examA['nombreAsignatura'] ;
                      ?>
                <div class="card text-white bg-dark mb-3" style="width: 100%;">
                    <div class="card-header"><p  style="font-size: 18px"><?php echo $asignatura ?></p></div>
                    <div class="card-body">            
                        <h4 class="card-title"  style="color:white;"><div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-5"><b>Nombre del profesor:</b> <?php echo $examA['profesor'] ?></div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4"><b>Fecha del examen:</b> <?php echo $examA['fechaExamen']?></div>
                        <div class="col-12 col-md-12 col-lg-4 col-xl-3 col-xxl-3"><b>Grado y grupo:</b> <?php echo $examA['grado']?></div></div></h4>

                        <p class="card-text" style="font-size: 17px"><b>Drescripción del examen:</b> <?php echo $examA['descr'] ?> </p>
                    </div>					
			</div>	

            <?php
            } 
            ?>

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