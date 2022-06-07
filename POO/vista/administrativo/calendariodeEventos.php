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

echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
else if(isset($_REQUEST['btnCrearEvento'])){
    if($_REQUEST['fechaInicioModal'] != null && $_REQUEST['fechaInicioModal'] >= $hoy){
        if($_REQUEST['fechaFinalModal'] != null && $_REQUEST['fechaFinalModal'] >= $hoy && $_REQUEST['fechaFinalModal'] >= $_REQUEST['fechaInicioModal']){
            if(empty($_REQUEST['nombreEventoModal'])!=true){
                if($_REQUEST['jornadaModal'] !=0 && $_REQUEST['jornadaModal'] ==1){
                    $ControladorEven->crearEvento($User->getidUsuario(),$_FILES['formFile']['name'],"Tarde");

                    //documento
                    $ruta = "../../../documentosEventos/";
                    $nombrefinal = trim($_FILES['formFile']['name']);                   
                    $upload = $ruta. $nombrefinal;  
                    if(move_uploaded_file($_FILES['formFile']['tmp_name'],$upload)){

                    }
                    ?>
                                     <script>
                                        Swal.fire({
                        position: 'bottom',
                        icon: 'success',
                        title: 'Evento creado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                        });
                          </script>
                                <?php
                }
            else if($_REQUEST['jornadaModal'] !=0 && $_REQUEST['jornadaModal'] ==2){
                $ControladorEven->crearEvento($User->getidUsuario(),$_FILES['formFile']['name'],"Mañana");
                                    //documento
                                    $ruta = "../../../documentosEventos/";
                                    $nombrefinal = trim($_FILES['formFile']['name']);                   
                                    $upload = $ruta. $nombrefinal;  
                                    if(move_uploaded_file($_FILES['formFile']['tmp_name'],$upload)){
                
                                    }
                                    ?>
                                     <script>
                                        Swal.fire({
                        position: 'bottom',
                        icon: 'success',
                        title: 'Evento creado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                        });
                          </script>
                                <?php
                }                   
            }
           else{
            $mensajeResponder ="Campo de nombre evento no válido";
           }             
        }
        else{
            $mensajeResponder ="Campo de fecha Final no válido";
        }
    }
    else{
        $mensajeResponder ="Campo de fecha Inicio no válido";
    }
}
else if(isset($_REQUEST['btnActualizarEvento'])){
    if($_REQUEST['fechaInicioModalActualizar'] != null){
        if($_REQUEST['fechaFinalModalActualizar'] != null && $_REQUEST['fechaFinalModalActualizar'] >= $_REQUEST['fechaInicioModalActualizar']){
            if(empty($_REQUEST['nombreEventoModalActualizar'])!=true){


                switch($_REQUEST['jornadaModalActualizar']){

                    case 1:
                     //extraer el nombre del documento
                     $doc = $ControladorEven->extraerNameDoc($_REQUEST['idEventoActualizar']);
                     $ControladorEven->actualizarEventoGeneral($_REQUEST['idEventoActualizar'],"Tarde");

                         //documento
                     if($_FILES['formFileActualizar']['name'] != null){   
                         $ControladorEven->actualizarEventoDocumento($_REQUEST['idEventoActualizar'],$_FILES['formFileActualizar']['name']);
                         if($doc == null && $doc ==""){
                         $ruta = "../../../documentosEventos/";
                         $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                         $upload = $ruta. $nombrefinal;  
                         if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                     }                       
                             }
                             else{
                                 unlink('../../../documentosEventos/'.$doc);
                                 $ruta = "../../../documentosEventos/";
                                 $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                                 $upload = $ruta. $nombrefinal;  
                                 if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                             }                       
                                     }
                         } 
                         ?>
                         <script>
                            Swal.fire({
                            position: 'bottom',
                            icon: 'success',
                            title: 'Evento actualizado con éxito (Recarge la página si no ve cambios)',
                            showConfirmButton: false,
                            timer: 1500
                            });
                            </script>
                        <?php
                    break;

                    case 2:
                     //extraer el nombre del documento
                     $doc = $ControladorEven->extraerNameDoc($_REQUEST['idEventoActualizar']);
                     $ControladorEven->actualizarEventoGeneral($_REQUEST['idEventoActualizar'],"Mañana");
 
                         //documento
                     if($_FILES['formFileActualizar']['name'] != null){   
                         $ControladorEven->actualizarEventoDocumento($_REQUEST['idEventoActualizar'],$_FILES['formFileActualizar']['name']);
                         if($doc == null && $doc ==""){
                         $ruta = "../../../documentosEventos/";
                         $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                         $upload = $ruta. $nombrefinal;  
                         if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                     }                       
                             }
                             else{
                                 unlink('../../../documentosEventos/'.$doc);
                                 $ruta = "../../../documentosEventos/";
                                 $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                                 $upload = $ruta. $nombrefinal;  
                                 if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                             }                       
                                     }
                         } 
                         ?>
                         <script>
                            Swal.fire({
                            position: 'bottom',
                            icon: 'success',
                            title: 'Evento actualizado con éxito (Recarge la página si no ve cambios)',
                            showConfirmButton: false,
                            timer: 1500
                            });
                            </script>
                        <?php
                    break;

                    case 3:
                        //extraer el nombre del documento
                        $doc = $ControladorEven->extraerNameDoc($_REQUEST['idEventoActualizar']);
                        $ControladorEven->actualizarEventoGeneral($_REQUEST['idEventoActualizar'],"Tarde");

                            //documento
                        if($_FILES['formFileActualizar']['name'] != null){   
                            $ControladorEven->actualizarEventoDocumento($_REQUEST['idEventoActualizar'],$_FILES['formFileActualizar']['name']);
                            if($doc == null && $doc ==""){
                            $ruta = "../../../documentosEventos/";
                            $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                            $upload = $ruta. $nombrefinal;  
                            if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                        }                       
                                }
                                else{
                                    unlink('../../../documentosEventos/'.$doc);
                                    $ruta = "../../../documentosEventos/";
                                    $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                                    $upload = $ruta. $nombrefinal;  
                                    if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                                }                       
                                        }
                            } 
                            ?>
                            <script>
                               Swal.fire({
                               position: 'bottom',
                               icon: 'success',
                               title: 'Evento actualizado con éxito (Recarge la página si no ve cambios)',
                               showConfirmButton: false,
                               timer: 1500
                               });
                               </script>
                           <?php
                    break;

                    case 4:
                    //extraer el nombre del documento
                    $doc = $ControladorEven->extraerNameDoc($_REQUEST['idEventoActualizar']);
                    $ControladorEven->actualizarEventoGeneral($_REQUEST['idEventoActualizar'],"Mañana");

                        //documento
                    if($_FILES['formFileActualizar']['name'] != null){   
                        $ControladorEven->actualizarEventoDocumento($_REQUEST['idEventoActualizar'],$_FILES['formFileActualizar']['name']);
                        if($doc == null && $doc ==""){
                        $ruta = "../../../documentosEventos/";
                        $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                        $upload = $ruta. $nombrefinal;  
                        if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                    }                       
                            }
                            else{
                                unlink('../../../documentosEventos/'.$doc);
                                $ruta = "../../../documentosEventos/";
                                $nombrefinal = trim($_FILES['formFileActualizar']['name']);                   
                                $upload = $ruta. $nombrefinal;  
                                if(move_uploaded_file($_FILES['formFileActualizar']['tmp_name'],$upload)){
                                            }                       
                                    }
                        } 
                        ?>
                        <script>
                           Swal.fire({
                           position: 'bottom',
                           icon: 'success',
                           title: 'Evento actualizado con éxito (Recarge la página si no ve cambios)',
                           showConfirmButton: false,
                           timer: 1500
                           });
                           </script>
                       <?php
                break;
                }              
            }
           else{
            $mensajeResponderActualizar ="Campo de nombre evento no válido";
           }             
        }
        else{
            $mensajeResponderActualizar ="Campo de fecha Final no válido";
        }
    }
    else{
        $mensajeResponderActualizar ="Campo de fecha Inicio no válido";
    }
}
else if(isset($_GET['btnEliminar'])){ 
        $id = $_GET['btnEliminar'];
  $doc = $ControladorEven->extraerNameDoc($id);
    if($doc != null && $doc !=""){  
        unlink('../../../documentosEventos/'.$doc); 

        $ControladorEven->eliminarEvento($id);                  
            }
            else{
                $ControladorEven->eliminarEvento($id);
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
    
    <title>My mutis | Calendario de Eventos</title>
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
                                  <li><a class="dropdown-item" href="perfil.php"><i class="fa fa-user-circle-o fa-lg"></i>&nbsp; Perfil</a></li>
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
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
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
                        <h3 class="text-themecolor">Calendario de Eventos</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Calendario de Eventos</li>
                        </ol>
                    </div>
                </div>

            <!--BOTON MODAL CREAR EVENTO-->
                <button type="button" class="btn btn-danger" style="width:100%;" data-bs-toggle="modal" data-bs-target="#crearEventoModal">Crear Evento</button>
                <br> <br>

                 <!--MODAL CREAR EVENTO-->
                 <div class="modal fade" id="crearEventoModal" tabindex="-1" aria-labelledby="crearEventoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="crearEventoModalLabel">Crear Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                             

                            <form class="mb-3" action="calendariodeEventos.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="fechaInicioModal" class="form-label">Fecha Inicio del evento:</label>
                            <input type="date" id="fechaInicioModal" name="fechaInicioModal"                                
                                            min="2022-01-01" max="2025-12-31" class="form-control">
                                    </div>
                                    
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <label for="fechaFinalModal" class="form-label">Fecha final del evento:</label>
                            <input type="date" id="fechaFinalModal" name="fechaFinalModal"                                
                                            min="2022-01-01" max="2025-12-31" class="form-control">
                                </div>
                                </div>
                                <br>

                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="nombreEventoModal" class="form-label">Nombre del evento:</label>
                                     <input type="text" class="form-control" id="nombreEventoModal" name="nombreEventoModal">
                                        </div> 
                                </div>
                                <br>

                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label for="jornadaModal" class="form-label">Jornada:</label>
                            <select class="form-select" aria-label="Default select example" name="jornadaModal" id="jornadaModal">                   
                                    <option selected value="0">Seleccione</option>
                                    <option value="1">Tarde</option>
                                    <option value="2">Mañana</option>
                                </select>
                                        </div>   

                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">   
                                        <label for="formFile" class="form-label">Adjuntar documentos:</label>
                                         <input class="form-control" type="file" id="formFile" name="formFile" accept=".pdf">
                                        </div>  
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="exampleFormControlTextarea1" class="form-label">Información del evento:</label>
                                         <textarea class="form-control" id="exampleFormControlTextarea1" name="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>   
                                </div>

                                <?php 
                                 echo "<h3>".$mensajeResponder."</h3>";
                                ?>

                                    <br>
                                <button type="submit" class="btn btn-danger" name="btnCrearEvento" style="width:100%;">Crear</button>
                        </form>

                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                               
                            </div>
                            </div>
                        </div>
                        </div>
             <!--fin MODAL CREAR EVENTO-->       
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

                if($_GET['estadoFiltrar'] != 0 && $_GET['fechaFiltrar'] == ""){
                            $events = $ControladorEven->filtrarEventosAdminEstado($_GET['estadoFiltrar']);
                        }
                else if($_GET['fechaFiltrar'] !="" && $_GET['estadoFiltrar'] == 0){
                            $events = $ControladorEven->filtrarEventosAdminFecha('"'.$_GET['fechaFiltrar'].'"');
                        }
                else if($_GET['estadoFiltrar'] != 0 && $_GET['fechaFiltrar'] != ""){
                            $events = $ControladorEven->filtrarEventosAdminFechaEstado($_GET['estadoFiltrar'],'"'.$_GET['fechaFiltrar'].'"');
                        }
                else{
                            $events = $ControladorEven->listarEventosAdmin();
                        }
								 foreach($events as $e){

								 ?>

                 <div class="col-12 col-sm-12 col-md-6 col-xl-3 text-center">
                   
								 <div class="card" style="width: 100%;">
										<img src="../../../images/banner.png" class="card-img-top" alt="...">
										<div class="card-body">
											<h3 class="card-title"><?php echo $e['nombreEvento']; ?> <br> <b>Fecha del evento: </b><?php echo $e['fechaInicio']; ?> <br> <b>Estado:</b> <?php echo $e['desEstado']; ?></h3>
											
                                            <div class="row"><div class="col-6 col-md-12 col-lg-6 col-xl-6 col-xxl-4">
                                            <button type="button" class="btn btn-success" style="width:100%" data-bs-toggle="modal" data-bs-target="#modalVer<?php echo $e['idEvento']; ?>">Visualizar</button>
                                            <br><br></div><div class="col-6 col-md-12 col-lg-6 col-xl-6 col-xxl-4">
                                            <button type="button" class="btn btn-dark" style="width:100%" data-bs-toggle="modal" data-bs-target="#actualizarEventoModal<?php echo $e['idEvento']; ?>">Actualizar</button>
                                            <br><br></div><div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                            <button type="button" class="btn btn-danger"  style="width:100%" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $e['idEvento']; ?>">Eliminar</button>
                                            </div></div>

                                        </div>
									</div>
                                    <br> 
                        </div>
                        <br>
                        <!-- Modal ELIMINAR-->
								<div class="modal fade" id="modalEliminar<?php echo $e['idEvento']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalEliminarLabel">ELIMINAR EVENTO</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
                                            ¿Estas seguro que deseas eliminar el evento? (El evento será borrado totalmente).
											</div>
											<div class="modal-footer text-muted">
                                            <a class="btn btn-danger" href="calendariodeEventos.php?btnEliminar=<?php echo $e['idEvento']; ?>">Eliminar</a>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>
							     <!-- Modal fin-ELIMINAR-->
                        <br> 
								<!-- Modal VISUALIZAR-->
								<div class="modal fade" id="modalVer<?php echo $e['idEvento']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalVerLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalVerLabel"><b>Fecha de inicio del evento:</b> 	<?php echo $e['fechaInicio']; ?> | <b>Jornada: </b><?php echo $e['jornada']; ?></h5>
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


                                  <!--MODAL ACTUALIZAR EVENTO-->
                 <div class="modal fade" id="actualizarEventoModal<?php echo $e['idEvento']; ?>" tabindex="-1" aria-labelledby="actualizarEventoModalModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="actualizarEventoModalModalLabel">Actualizar Evento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                             

                            <form class="mb-3" action="calendariodeEventos.php" method="POST" enctype="multipart/form-data">
                                
                            <input type="text" class="form-control" id="idEventoActualizar" name="idEventoActualizar" value="<?php echo $e['idEvento']; ?>">
                            
                            <div class="row">
                            <label for="organi" class="form-label">Organizador</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="text" class="form-control" id="organi" value="<?php echo $e['creador']; ?>" disabled>                                   
                        </div>
                            </div>

                            <br>

                            <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="fechaInicioModalActualizar" class="form-label">Fecha Inicio del evento:</label>
                            <input type="date" id="fechaInicioModalActualizar" name="fechaInicioModalActualizar"                                
                                            min="2022-01-01" max="2025-12-31" class="form-control" value="<?php echo $e['fechaInicio']; ?>">
                                    </div>
                                    
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                            <label for="fechaFinalModalActualizar" class="form-label">Fecha final del evento:</label>
                            <input type="date" id="fechaFinalModalActualizar" name="fechaFinalModalActualizar"                                
                                            min="2022-01-01" max="2025-12-31" class="form-control" value="<?php echo $e['fechaFin']; ?>">
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="nombreEventoModalActualizar" class="form-label">Nombre del evento:</label>
                                     <input type="text" class="form-control" id="nombreEventoModalActualizar" name="nombreEventoModalActualizar" value="<?php echo $e['nombreEvento']; ?>">
                                        </div>   
                                </div> 
                                <br>            
                                <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">   
                                <label for="estadoActualizar" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" name="estadoActualizar" id="estadoActualizar">                   
                                    <?php 
                                    if($e['idEstadoEvento'] == 1){
                                            $estado2 = 2;
                                            $estado1 = 1;
                                            $text1 = "Activo";
                                            $text2 = "Inactivo";
                                    }
                                    else{
                                        $estado2 = 1;
                                        $estado1 = 2;
                                        $text1 = "Inactivo";
                                        $text2 = "Activo";
                                    }
                                    ?>
                                <option selected value="<?php echo $estado1; ?>"><?php echo $text1; ?></option>
                                    <option value="<?php echo $estado2; ?>"><?php echo $text2; ?></option>
                                    </select>
                                        </div> 

                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <label for="jornadaModalActualizar" class="form-label">Jornada:</label>
                            <select class="form-select" aria-label="Default select example" name="jornadaModalActualizar" id="jornadaModalActualizar">   
                            <?php 
                                    if(strcmp($e['jornada'], "Tarde") === 0){
                                            $jorndaValidar = 3;
                                    }
                                    else{
                                        $jorndaValidar = 4;
                                    }
                                    ?>

                                    <option selected value="<?php echo $jorndaValidar; ?>"><?php echo $e['jornada']; ?></option>
                                    <option value="1">Tarde</option>
                                    <option value="2">Mañana</option>
                                </select>
                                        </div>    
                                </div>
                                <br>
                                <div class="row">
                                    
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">   
                                        <label for="formFileActualizar" class="form-label">Actualizar documento:</label>
                                         <input class="form-control" type="file" id="formFileActualizar" name="formFileActualizar" accept=".pdf">
                                        </div> 
                                    </div>
                                <br>
                                <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <label for="exampleFormControlTextarea1Actualizar" class="form-label">Información del evento:</label>
                                         <input type="text" class="form-control" id="exampleFormControlTextarea1Actualizar" name="exampleFormControlTextarea1Actualizar" style="height:120px;" value="<?php echo $e['informacionEvento']; ?>"></input>
                                        </div>   
                                </div>

                                <?php 
                                 echo "<h3>".$mensajeResponderActualizar."</h3>";
                                ?>

                                    <br>
                                <button type="submit" class="btn btn-danger" name="btnActualizarEvento" style="width:100%;">Actualizar</button>
                        </form>

                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                               
                            </div>
                            </div>
                        </div>
                        </div>
             <!--fin MODAL ACTUALIZAR EVENTO-->    
             
                                 <?php 
								
                            }
                            
                            ?>																							
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