<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];
    date_default_timezone_set('America/Bogota');
    $hoy = date("Y-m-d");
    require_once("../../modelo/examen.php");
    require_once("../../controlador/ControladorExamen.php");
    require_once("../../modelo/usuario.php");
    require_once("../../controlador/ControladorUsuario.php");
    require_once("../../controlador/ControladorGrupoxGradoxUsuario.php");
    require_once("../../controlador/ControladorGrupoxGrado.php");

    $Controladorgxg = new ControladorGrupoxGrado();

    $listargxg = $Controladorgxg->listarGG();
	$exam = new examen();
	$ControladorExam = new ControladorExamen();
    $ControladorUsuario = new ControladorUsuario();
    $usuario = new usuario();
    $ControladorGrupoxGradoxUsuario = new ControladorGrupoxGradoxUsuario();

//
$User = $ControladorUsuario->unUsuario($logeado);
$directorGrupo = $ControladorGrupoxGradoxUsuario->listarGGU($User->getidUsuario());

$Citador = $ControladorExam->listarCitador($logeado);
foreach($Citador as $cit){
			$citadorr= $cit['idUsuario'];
}
$listar = $ControladorExam->listarAsignaturasP($citadorr);

echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['botonAgregar'])){
    if($_REQUEST['descr'] != ""){
        if($_REQUEST['idGradoxGrupos'] !=0 ){
            if($_REQUEST['idAsignaturas'] !=0 ){
                if($_REQUEST['start'] != null && $_REQUEST['start'] >= $hoy){
                        //obtener id del agendador del examen
                        $Citador = $ControladorExam->listarCitador($logeado);
                        foreach($Citador as $cit){
                                $citador= $cit['idUsuario'];
                        }              	
                    //Agendar Examen

                    $ControladorExam ->registrarExamen($citador);  
                    ?>
                        <script>
                        Swal.fire({
                                title: 'Se agendó exitosamente el examen',
                                icon: 'success',
                                showConfirmButton: false,
                                html:'<a class="btn btn-success" href="../../../POO/vista/docente/examenes.php" role="button">Aceptar</a> '
                                });
                        </script>
                    <?php
                }
                else {
                    ?>
                    <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se puede agendar el examen, la fecha es invalida'
                    })
                    </script>
                    <?php
                }
            }
            else {
                ?>
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se pudó agendar '
                })
                </script>
                <?php
            }
        }
        else {
            ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No se puede agendar el examen, Debe seleccionar un grupo'
            })
            </script>
            <?php
        }
    }
    else {
        ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El examen no puede estar sin titulo'
        })
        </script>
        <?php
    }
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
<?php 
    if($directorGrupo == 1 || $directorGrupo == 2){

                            }
                            else{

                                ?>
                                <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
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
                    <div class="col-md-8 align-self-center">
                        <h3 class="text-themecolor">Exámenes</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Exámenes</li>
                        </ol>
                    </div>
                </div>
            
				<div class="row">
											<?php    foreach ($listar as $listAsis) {
												
												?>
                 				<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3">
												 
						<center>
									<div class="card" style="width: 18rem;">
											<img src="../../../images/examenes/<?php echo $listAsis['img']?>" class="card-img-top" alt="...">
												<div class="card-body">
												<input type="hidden" name="idAsignatura" id="idAsignatura" value="<?php  echo $listAsis['idAsignatura']?>">
													<h3 class="card-title"> <?php  echo $listAsis['nombreAsignatura']?></h3>
													<a href="examenesListar.php?idAsigna=<?php echo $listAsis['idAsignatura']?>" class="btn btn-dark">Abrir</a>
													<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalAdd<?php echo $listAsis['idAsignatura'] ?>">Programar Examen</button> 
												</div>
									</div>
									<br>
									</center>
													
                        </div>
											
<!-- Modal -->
		<div class="modal fade" id="ModalAdd<?php echo $listAsis['idAsignatura'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="">
			
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Programar examen</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-body">	
			  	<div class="col-12 col-md-12 col-lg-12">
					<label for="descr" class="form-label">Descripción del examen: </label>
					  <input type="text" name="descr" class="form-control" id="descr" placeholder="">
				  </div>

				  <br>
				  <div class="row">
				  <div class="col-12 col-md-6 col-lg-6">
                                <label for="idGradoxGrupos" class="form-label">Grupo y grado:</label>
                                <select class="form-select"  name="idGradoxGrupos" id="idGradoxGrupos">
                                        <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                    </div>
                    
					<div class="col-12 col-md-6 col-lg-6">
                                <label for="idAsignaturas" class="form-label">Asignaturas:</label>
                
                                        <select class="form-select" id="idAsignaturas" name="idAsignaturas">
															<option selected value="<?php echo $listAsis['idAsignatura'] ?>"><?php  echo $listAsis['nombreAsignatura']?></option>
                                          </select>
                                </div>
							</div>
							<br>
					<div class ="row">	
				  <div class="col-12 col-md-12 col-lg-12">
					<label for="start" class="form-label">Fecha Examen</label>
					  <input type="date" name="start" class="form-control" id="start" >
				  </div>
				  <br>
	
				  </div>	
			  </div>
              <div class="col-12 col-md-12 col-lg-12">
              <center>
                    <p><?php 
                    if(isset($validar)){
                    echo $validar; }?></p></center>
              </div>
			  <div class="col-auto">
					<center>
					<button type="submit" class="btn btn-success" name="botonAgregar">Programar Examen</button>
				
					</center>
             </div>
			</form>
			<br>
			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      		</div>
			</div>
		  </div>
		</div>
		<?php    
															}
															?>
		    <!--fin modal----> 
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