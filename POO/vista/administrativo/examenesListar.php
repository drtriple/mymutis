<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

	require_once("../../modelo/examen.php");
    require_once("../../controlador/ControladorExamen.php");
    require_once("../../modelo/usuario.php");
    require_once("../../controlador/ControladorUsuario.php");
    require_once("../../controlador/ControladorGrupoxGrado.php");

    $Controladorgxg = new ControladorGrupoxGrado();
    $listargxg = $Controladorgxg->listarGG();
    $ControladorUsuario = new ControladorUsuario();
    $usuario = new usuario();
    $exam = new examen();
    $ControladorExam = new ControladorExamen();   
    
    
$idAsigna = $_REQUEST['idAsigna'];

$User = $ControladorUsuario->unUsuario($logeado);
$listar = $ControladorExam->listarExamen($idAsigna);

#$listar1 = $ControladorExam->listarAsignaturasA();
$listar2 = $ControladorExam->listarNAsignaturas($idAsigna);

echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonEditar'])){
    if($_REQUEST['descr'] != ""){
        if($_REQUEST['idGradoxGrupos'] !=0 ){
            if($_REQUEST['idAsignaturas'] !=0 ){
                        //Actualizar Examen
                        $ControladorExam ->actualizarExamen(); 
                        ?>
                            <script>
                            Swal.fire({
                                    title: 'Se actualizó exitosamente el examen',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    html:'<a class="btn btn-success" href="../../../POO/vista/administrativo/examenes.php" role="button">Aceptar</a> '
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
else if(isset($_REQUEST['botonEliminar'])){

        
    $ControladorExam->EliminarExamen($_GET['idExa']);
    ?>
    <script>
    Swal.fire({
            title: 'Se eliminó exitosamente el examen',
            icon: 'success',
            showConfirmButton: false,
            html:'<a class="btn btn-success" href="../../../POO/vista/administrativo/examenes.php" role="button">Aceptar</a> '
            });
    </script>
    <?php
}
else if(isset($_REQUEST['botonCerrar'])){
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
                                    <li><a class="dropdown-item" href="perfil.php"><i class="fa fa-user-circle-o fa-lg"></i>&nbsp; Perfil</a></li>
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
                    
                        <h3 class="text-themecolor">Exámenes | <?php echo $listar2; ?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Exámenes</li>   
                                                         
                        </ol>
            
                   </div>
                </div> 


                <a class="btn btn-success" href="examenes.php" style="width:100%;">Atrás</a>
                                   <input type="hidden" name="idAsigna" value="<?php echo $_GET['idAsigna']?>">
<br><br>
                    <?php 
                          
                    foreach ($listar as $examA) {
                              
                        $asignatura = $examA['nombreAsignatura'];
                      ?>
                <div class="card text-white bg-dark mb-3" style="width: 100%;">
                    <div class="card-header"><p  style="font-size: 18px"><?php echo $asignatura ?></p></div>
                    <div class="card-body">            
                        <h4 class="card-title" style="color:white;"><div class="row"><div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-5"><b>Nombre del profesor:</b> <?php echo $examA['profesor'] ?> </div><div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4"><b>Fecha del examen:</b> <?php echo $examA['fechaExamen']?> </div><div class="col-12 col-md-12 col-lg-4 col-xl-3 col-xxl-3"><b>Grado y grupo:</b> <?php echo $examA['grado']?></div></div></h4>
                        <p class="card-text" style="font-size: 17px"><b>Drescripción del examen:</b> <?php echo $examA['descr'] ?> </p>
                        
                        <div class="row"><div class="col-12 col-sm-6">
                        <button type="button" class="btn btn-success" style="width:100%" data-bs-toggle="modal" data-bs-target="#ModalAdd<?php echo $examA['idExamen'] ?>">Editar Examen</button> 
                        
                        </div><br><br>
                        <div class="col-12 col-sm-6">
                        <button type="button" class="btn btn-danger" style="width:100%"  data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $examA['idExamen']?>">Eliminar Examen</button>
                        </div></div>
                    </div>					
			</div>	
            <!---------MODAALLLLLLLLLLLLLLLLLLLLLLLLL-------------------->	 
            <div class="modal fade" id="ModalAdd<?php echo $examA['idExamen'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="examenesListar.php?idExamen=<?php echo $examA['idExamen'];?>">
			
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Editar examen</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
              <input type="hidden" name="idAsigna" value="<?php echo $_GET['idAsigna']?>">
			  <div class="modal-body">	
              <div class="col-12 col-md-12 col-lg-12">
					<label for="descr" class="form-label">Descripción del examen: </label>
					  <input type="text" name="descr" class="form-control" id="descr" value="<?php echo $examA['descr'] ?>">
				  </div>

				  <br>
				  <div class="row">
				  <div class="col-12 col-md-6 col-lg-6">
                                <label for="idGradoxGrupos" class="form-label">Grupo y grado:</label>
                                        <select class="form-select"  name="idGradoxGrupos" id="idGradoxGrupos">
                                            <option selected value="<?php echo $examA['idGradoxGrupos']?>"><?php echo $examA['grado']?> (Agendado
                                            )</option>
                                            <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                    </div>
					<div class="col-12 col-md-6 col-lg-6">
                                <label for="idAsignaturas" class="form-label">Asignaturas:</label>
                                        <select class="form-select" id="idAsignaturas" name="idAsignaturas">
													<option selected value="<?php  echo $_GET['idAsigna']?>"><?php  echo $examA['nombreAsignatura']?></option>
                                          </select>
                                </div>
							</div>
							<br>
					<div class ="row">	
				  <div class="col-12 col-md-12 col-lg-12">
					<label for="start" class="form-label">Fecha Examen</label>
					  <input type="date" name="start" class="form-control" id="start" value="<?php echo $examA['fechaExamen']?>">
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
					<button type="submit" class="btn btn-success" name="botonEditar">Editar Examen</button>
				
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
        <!------------------------------FIN MODAL EDITARRRRRRRRRRRR-------------------------->  
                     <!-- Modal ELIMINARRRRRRRRRR-->
                     <div class="modal fade" id="modalEliminar<?php echo $examA['idExamen']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEliminarLabel">ELIMINAR EXAMEN</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <input type="hidden" name="idAsigna" value="<?php echo $_GET['idAsigna']?>">
                            ¿Estas seguro que deseas eliminar el Examen? (El examen será borrado totalmente).
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <a class="btn btn-danger" href="examenesListar.php?botonEliminar&idExa=<?php echo $examA['idExamen'];?>&idAsigna=<?php echo $_REQUEST['idAsigna']?>">Eliminar</a>
                            </div>
                            </div>
                        </div>
                    </div>   
            <?php
            } 
            ?>

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
      //header("Location:https://mymutis.000webhostapp.com/");
}
?>