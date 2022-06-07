<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];

   require_once("../../controlador/ControladorCita.php");
   require_once("../../controlador/ControladorCorreo.php");
   require_once("../../controlador/ControladorUsuario.php");
   require_once("../../controlador/ControladorGrupoxGradoxUsuario.php");
   require_once("../../controlador/ControladorGrupoxGrado.php");

   $ControladorGrupoxGradoxUsuario = new ControladorGrupoxGradoxUsuario();
   $ControladorUsuario = new ControladorUsuario();
   $ControladorCita = new ControladorCita();
   $ControladorCorreo = new ControladorCorreo();
   $Controladorgxg = new ControladorGrupoxGrado();

   $User = $ControladorUsuario->unUsuario($logeado);

//listas
$listargxg = $Controladorgxg->listarGG();
$directorGrupo = $ControladorGrupoxGradoxUsuario->listarGGU($User->getidUsuario());
$listaCita = $ControladorCita->listarCitasP($logeado);

echo '<link rel="icon" type="image/jpg" href="../../../images/icons/mutis.jpg"/><body><script src="../../../vendor/sweetalert2/dist/sweetalert2.all.min.js"></script></body>';

if(isset($_REQUEST['botonCrear'])){
    if($_REQUEST['idUsuarioCitado'] != 0 ){
        if($_REQUEST['FechaCita'] != null && $_REQUEST['FechaCita'] >= $hoy){
            if($_REQUEST['hora'] != null){
                if($_REQUEST['descr'] != ""){
                    $listaRol = $ControladorCita->listarRol($_REQUEST['idUsuarioCitado']) ;
                        if($listaRol == 1 ){
                           //obtener id del citado
                           $CorreoCitado = $ControladorCita->listarCitado($_REQUEST['idUsuarioCitado']);
                           //crear Cita
                           $ControladorCita->registrarCita($User->getidUsuario(),$_REQUEST['idUsuarioCitado']);  
                           //enviarCorreo
                           $fecha = $_REQUEST['FechaCita'];
                           $descr = $_REQUEST['descr'];
                           $nombreCitador = $User->getnombresUsuarios()." ".$User->getapellidosUsuarios();
                           $nombreEstudiante = $ControladorCita->extraerNombreCitado($_REQUEST['idUsuarioCitado']);
                           $documentoEstudiante = $ControladorCita->extraerDocumentoCitado($_REQUEST['idUsuarioCitado']);
                       
                           $ControladorCorreo->enviarCorreoCita($descr,$fecha,$CorreoCitado,$_REQUEST['hora'],$User->getidRolUsuario(),$nombreCitador,$nombreEstudiante,$documentoEstudiante);
                            ?>
                       <script>
                       Swal.fire({
                               title: 'Se creo exitosamente la cita',
                               icon: 'success',
                               showConfirmButton: false,
                               html:'<a class="btn btn-success" href="citas.php" role="button">Aceptar</a> '
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
                        text: 'No se puede agendar la cita por el documento del estudiante'
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
                        text: 'Descripción vacÍa'
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
                        text: 'Campo de hora no válido'
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
                text: 'Campo de fecha no válido'
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
            text: 'No se pudo agendar, revisa el estudiante'
        })
        </script>
        <?php
    }

}
else if(isset($_REQUEST['botonActualizarCitado'])){
    if($_REQUEST['descrEditar'] != ""){
        //obtener id del citado
        $CorreoCitado = $ControladorCita->listarCitado($_REQUEST['idUsuarioCitadoEditar']);
        //crear Cita
        $ControladorCita->actualizarCitado();  
        //enviarCorreo
        $fecha = $_REQUEST['fechaCitaEditar'];
        $descr = $_REQUEST['descrEditar'];
        $nombreCitador = $User->getnombresUsuarios()." ".$User->getapellidosUsuarios();
        $nombreEstudiante = $ControladorCita->extraerNombreCitado($_REQUEST['idUsuarioCitadoEditar']);
        $documentoEstudiante = $ControladorCita->extraerDocumentoCitado($_REQUEST['idUsuarioCitadoEditar']);

        $ControladorCorreo->enviarCorreoCitaActualizado($descr,$fecha,$CorreoCitado,$_REQUEST['horaEditar'],$User->getidRolUsuario(),$nombreCitador,$nombreEstudiante,$documentoEstudiante);
        ?>
            <script>
            Swal.fire({
                    title: 'Se actualizó exitosamente la cita',
                    icon: 'success',
                    showConfirmButton: false,
                    html:'<a class="btn btn-success" href="citas.php" role="button">Aceptar</a> '
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
            text: 'No se puede agendar la cita por el documento del estudiante'
        })
        </script>
        <?php
    }
}
else if(isset($_REQUEST['botonEliminarPregunta'])){

        
        $ControladorCita->EliminarCita($_GET['idCit']);
        ?>
            <script>
            Swal.fire({
                    title: 'Se eliminó exitosamente la cita',
                    icon: 'success',
                    showConfirmButton: false,
                    html:'<a class="btn btn-success" href="../../../POO/vista/docente/citas.php" role="button">Aceptar</a> '
                    });
            </script>
        <?php
}
else if(isset($_REQUEST['botonActualizarC'])){

        if($_REQUEST['conclusionCita2'] != ""){
        
            $ControladorCita->actualizarConclusion();  
            ?>
                <script>
                Swal.fire({
                        title: 'Se concluyó exitosamente la cita',
                        icon: 'success',
                        showConfirmButton: false,
                        html:'<a class="btn btn-success" href="../../../POO/vista/docente/citas.php" role="button">Aceptar</a> '
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
                text: 'La conclusión no puede estar vacia'
            })
            </script>
            <?php
        }

}
else if(isset($_REQUEST['botonActualizarI'])){

        if($_REQUEST['conclusionCita'] != ""){   
            $ControladorCita->actualizarConclusionI(); 
            ?>
                <script>
                Swal.fire({
                        title: 'Se actualizó la conclusión de la cita exitosamente',
                        icon: 'success',
                        showConfirmButton: false,
                        html:'<a class="btn btn-success" href="../../../POO/vista/docente/citas.php" role="button">Aceptar</a> '
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
                text: 'No se pudo editar la conclusión'
            })
            </script>
            <?php
        }

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
    
    <title>My mutis | Citas</title>

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
<style type="text/css">
.scroll_vertical {
	height: 400px;
	width: 100%;
	overflow: auto;
	padding: 8px;
}
</style>

<body class="fix-header fix-sidebar card-no-border">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis | Citas</p>
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
                               <li><a class="dropdown-item" href="citas.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
                              
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
                                <li> <a class="waves-effect waves-dark" href="examenes.php" aria-expanded="false"><i
                                            class="fa fa-users"></i><span class="hide-menu">Exámenes</span></a>
                                </li>
        
                                <?php
                            }
                        ?>

                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
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
                        <h3 class="text-themecolor">Citas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Citas</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">

                            <h2>Crear Cita</h2>
                            
                                <form action="" method="POST">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <input type="hidden"
                                                        class="form-control" name="Citador " id="Citador " aria-describedby="helpId" placeholder="<?php echo $logeado?>"  disabled>
                                            <input type="hidden"
                                                        class="form-control" name="idCitador" id="idCitador" value="<?php echo $Citador?>">          
                                        </div>

                                        <br>
                                        <div class="row">
                                        <div  class="col-12 col-md-6 col-lg-6">
                                        <label for="gxgEstudiante" class="form-label">Grupo del estudiante:</label>
                                            <select class="form-select"  name="gxgEstudiante" id="gxgEstudiante">
                                                <option selected value="0">Seleccionar un grupo</option>
                                                <?php foreach ($listargxg as $ggFiltrar) { ?>
                                                <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                            <?php } ?>
                                            </select>
                                            <br>
                                        </div>
                                        
                                        <div  class="col-12 col-md-6 col-lg-6">
                                            <label for="Estudiante" class="form-label">Nombre del estudiante:</label>
                                                <div id="myDiv">
                                                    <select class="form-select" name="idUsuarioCitado" id="idUsuarioCitado">
                                                    <option selected value="0">Esperando un grupo...</option>
                                                    </select>
                                                </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                    
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="hora" class="form-label">Hora de la cita: </label>
                                            <input type="time"
                                                        class="form-control" name="hora" id="hora" min="06:00" max="18:00"  aria-describedby="helpId">
                                        </div>

                                        
                                        <div class="col-12 col-md-6 col-lg-6">
                                            <label for="FechaCita" class="form-label">Fecha de la citación:</label>
                                            <input type="date"
                                            class="form-control" name="FechaCita" id="FechaCita" aria-describedby="helpId" placeholder="">
                                        </div>

                                    </div>
                                            <br>
                                                                                

                                        <div class="col-12 col-md-12 col-lg-12">
                                            <label for="Lugar" class="form-label">Lugar de la cita:</label>
                                            <input type="text"
                                            class="form-control" name="Lugar" id="Lugar" aria-describedby="helpId" placeholder="I.E José Celestino Mutis" disabled>
                                        </div>
                                        <br>
                                            <div class="row">

                                                <div class="col-12 col-md-12 col-lg-12">
                                            <label for="descripcion" class="form-label">Descripción: </label>
                                            <textarea  rows="3" class="form-control" name="descr" id="descr" aria-describedby="helpId" placeholder="" ></textarea>
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

                                    <div class="col-auto">
                                        <center>
                                      <button type="submit" class="btn btn-danger mb-3" name="botonCrear" style="width:50%;">Crear</button>
                                      </center>
                                    </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                
                </div>

        <br>
            
          <BR>
               <!--ofical------->
               <div class="row">
               
                
               <div class="col-lg-12 col-md-12">
                
                <div class="card card-body mailbox table-responsive">
                    <h4 class="card-title">CITAS AGENDADAS</h4>
                    <div class="scroll_vertical">  
                    <?php	
                        foreach($listaCita as $listarCitas){ 
                        ?>
                          <div class="card border-success mb-3" style="width: 100%;">
                       <div class="card-header bg-transparent"><div class="row"><div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-3"><b>Rol: </b> <?php echo $listarCitas['RolS']; ?></div><div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-4"><b>Citador:  </b> <?php echo $listarCitas['Nombre citador']; ?></div><div class="col-12 col-md-12 col-lg-4 col-xl-5 col-xxl-5"> <b>Fecha de la cita:</b> <?php echo $listarCitas['fecha'];?> / <b>Hora de la cita:</b> <?php echo $listarCitas['hora']; ?> </div><div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-6"> <b>Lugar:</b> I.E José Celestino Mutis </div><div class="col-12 col-md-6 col-lg-4 col-xl-5 col-xxl-6"> <b>Estado cita: </b><?php echo $listarCitas['dcrs']; ?></div></div></div>
                       <div class="card-body text-dark">
                           <h5 class="card-title"><div class="row"><div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4"><b><?php echo $listarCitas['RolP']; ?></b> <?php echo $listarCitas['Nombre estudiante']; ?></div><div class="col-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4"><b>Correo</b> <?php echo $listarCitas['correo']?></div><div class="col-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4"> <b>Documento del estudiante:</b> <?php echo $listarCitas['docUsuario'];?></div></div> </h5>
                           
                            <p class="card-text"><b>Motivo:</b> <?php echo $listarCitas['descr']?></p>
                       </div>
                       
                       <div class="card-footer bg-transparent border-success">
                       <div class="row">
                       <div class="col-lg-9 col-md-9"><p>Conclusión: <?php echo $listarCitas['conclusion'];?></p>
                </div>
               <div class="col-lg-3 col-md-3">
                           <?php                
                           if($listarCitas['dcrs'] == "Activa"){
                               ?>
                               <div class="row"><div class="col-12 col-md-12 col-lg-7 col-xl-6 col-xxl-6">
                               <button type="button" class="btn btn-danger" style="width:100%" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $listarCitas['idcita'];?>" >Concluir</button> 
                             <br><br> </div><div class="col-12 col-md-12 col-lg-5 col-xl-6 col-xxl-6">
                               <button type="button" class="btn btn-success" style="width:100%" data-bs-toggle="modal" data-bs-target="#exampleModalED<?php echo $listarCitas['idcita']; ?>" >Editar</button>                             
                               </div></div>               
                              <?php
                           }
                           else
                           {  
                               ?>
                               <div class="row"><div class="col-12 col-md-12 col-lg-7 col-xl-6 col-xxl-6">
                   <button type="button" class="btn btn-dark"  style="width:100%" data-bs-toggle="modal" data-bs-target="#modalEliminar<?php echo $listarCitas['idcita']?>">Eliminar</button>
                   <br><br> </div><div class="col-12 col-md-12 col-lg-5 col-xl-6 col-xxl-6">       
                   <button type="button" class="btn btn-success" style="width:100%" data-bs-toggle="modal" data-bs-target="#exampleModalE<?php echo $listarCitas['idcita']?>">Editar</button>
                   </div></div>     
<!------EDITARRRRRRR CONCLUIRRRRR-->
<div class="modal fade" id="exampleModalE<?php echo $listarCitas['idcita']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Editar conclusión</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
  <form action="citas.php?idCita=<?php echo $listarCitas['idcita'];?>" method="POST">
                     <div class="row">


                      <input type="hidden"
                        class="form-control" name="idCita" id="idCita" value="<?php echo $listarCitas['idcita']?>" disabled>

                            <div class="col-12 col-md-12 col-lg-12">
                        <label for="idCitadorConcluir" class="form-label">Citador:</label>
                        <input type="text"
                                 class="form-control" name="idCitadorConcluir" id="idCitadorConcluir" aria-describedby="helpId" placeholder="<?php echo $listarCitas['Nombre citador'];  ?>" disabled>
                            
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                        <input type="hidden"
                                 class="form-control" name="EstadoCita" id="EstadoCita" aria-describedby="helpId" value="2" disabled>
                            
                                </div>

                            </div>
                            <div class="row">
                                </div>
                              
                                    <br>
                                <div class="row">

                           <div class="col-12 col-md-12 col-lg-12">
                           <label for="conclusionCita" class="form-label">Conclusión de la Cita:</label>
                           <textarea class="form-control" name="conclusionCita" id="conclusionCita"  aria-describedby="helpId"><?php echo $listarCitas['conclusion']?></textarea>


                                        </div>

                                    </div>

                                   

                                    <br>

                                    <p><?php 
                                if(isset($mensajeActualizarI)){
                                echo $mensajeActualizarI; }?></p>

                              
                                <div class="col-auto">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="botonActualizarI">Actualizar cambios</button>
                              
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
                            <!-- Modal ELIMINARRRRRRRRRR-->
                <div class="modal fade" id="modalEliminar<?php echo $listarCitas['idcita']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">ELIMINAR CITA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        ¿Estas seguro que deseas eliminar la cita? (La cita será borrada totalmente).
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a class="btn btn-danger" href="citas.php?botonEliminarPregunta&idCit=<?php echo $listarCitas['idcita']; ?>">Eliminar</a>
                        </div>
                        </div>
                    </div>
                </div>

                            <?php   
                        }
                        ?>
            </div>
                    </div>
                      
                    
                            </div>
                     
                    
                    </div>
                    

                           
                    
                       

<!-- FIN Modal EDITAR-->
                       <!-- Modal CONCLUIR-->
<div class="modal fade" id="exampleModal<?php echo $listarCitas['idcita'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModal">Concluir cita</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
  <form action="citas.php?idCitaconclusion=<?php echo $listarCitas['idcita'];?>" method="POST">
                     <div class="row">

                      <input type="hidden"
                        class="form-control" name="idCitaconclusion" id="idCitaconclusion" value="<?php echo $listarCitas['idcita'] ?>" disabled>

                            <div class="col-12 col-md-12 col-lg-12">
                        <label for="idCitadorconclusion" class="form-label">Citador:</label>
                        <input type="text"
                                 class="form-control" name="idCitadorconclusion" id="idCitadorconclusion" aria-describedby="helpId" placeholder="<?php echo $listarCitas['Nombre citador']; ?>" disabled>
                            
                                </div>

                            </div>
                            <br>
                            <div class="row">

                            <div class="col-12 col-md-6 col-lg-6">
                            <label for="FechaCitaconclusion" class="form-label">Documento estudiante:</label>
                            <input type="text"
                            class="form-control" name="FechaCitaconclusion" id="FechaCitaconclusion" aria-describedby="helpId" placeholder="<?php echo $listarCitas['docUsuario'];?>"disabled>
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                            <label for="idEstadoCitaconclusion" class="form-label">Estado de la cita:</label>
                                    <select class="form-select"  name="idEstadoCitaconclusion" id="idEstadoCitaconclusion">
                                        <option selected value="2">Inactivo</option> 
                                      </select>
                                          </div>

                                </div>
                              
                                    <br>
                                <div class="row">

                           <div class="col-12 col-md-12 col-lg-12">
                           <label for="conclusionCita2" class="form-label">Conclusión de la Cita:</label>
                           <textarea
                                  class="form-control" name="conclusionCita2" id="conclusionCita2" aria-describedby="helpId" placeholder=""></textarea>

                                        </div>

                                    </div>

                                   

                                    <br>

                                    <p><?php 
                                if(isset($mensajeConcluir)){
                                echo $mensajeConcluir; }?></p>

                              
                                <div class="col-auto">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="botonActualizarC">Actualizar cambios</button>
                              
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
<!-- FIN Modal EDITAR-->

<!--  Modal EDITAR CITADOOOOOOOOOOOOOOOOOOOOOOOO-->
<div class="modal fade" id="exampleModalED<?php echo $listarCitas['idcita'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Editar cita</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
  <form action="citas.php?idCitaEditar=<?php echo $listarCitas['idcita'];?>" method="POST">
                     <div class="row">

                     <input type="hidden"class="form-control" name="idUsuarioCitadoEditar" id="idUsuarioCitadoEditar" aria-describedby="helpId" value="<?php echo $listarCitas['citado'];?>" >

                            <div class="col-12 col-md-12 col-lg-12">
                        <label for="idCitadorEditar" class="form-label">Citador:</label>
                        <input type="text"
                                 class="form-control" name="idCitadorEditar" id="idCitadorEditar" aria-describedby="helpId" placeholder="<?php echo $listarCitas['Nombre citador']; ?>" disabled>
                            
                                </div>

                            </div>
                            <br>
                            <div class="row">
                            
                            <div class="col-12 col-md-4 col-lg-4">
                            <label for="FechaCitaEditar" class="form-label">Fecha de la cita:</label>
                            <input type="date"
                            class="form-control" name="fechaCitaEditar" id="FechaCitaEditar" aria-describedby="helpId" value="<?php echo $listarCitas['fecha'];  ?>">
                            </div>
                            <div class="col-12 col-md-4 col-lg-4">
                            <label for="horaEditar" class="form-label">Fecha de la cita:</label>
                            <input type="time"
                            class="form-control" name="horaEditar" id="horaEditar" aria-describedby="helpId" value="<?php echo $listarCitas['hora'];  ?>">
                            </div>

                            <div class="col-12 col-md-4 col-lg-4">
                            <label for="idEstadoCitaEditar" class="form-label">Estado de la cita:</label>
                                    <select class="form-select"  name="idEstadoCitaEditar" id="idEstadoCitaEditar">
                                        <option selected value="1">Inactivo</option> 
                                        
                                      </select>
                            </div>

                                </div>
                                <br>
                                <div class="row">

                           <div class="col-12 col-md-12 col-lg-12">
                           <label for="descrEditar" class="form-label">Motivo de la Cita:</label>
                           <textarea class="form-control" name="descrEditar" id="descrEditar" aria-describedby="helpId" rows="3"><?php echo $listarCitas['descr'];?></textarea>
                            </div>

                                    </div>

                                   

                                    <br>

                                    <p><?php 
                                if(isset($mensajeActualizar)){
                                echo $mensajeActualizar; }?></p>

                              
                                <div class="col-auto">
                                    <center>
                                    <button type="submit" class="btn btn-success" name="botonActualizarCitado">Actualizar cambios</button>
                              
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
                    //fin foreach
                        }
                    ?>


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

    <script language="javascript">

    $(document).ready(function(){

        $("#gxgEstudiante").on('change', function () {

            $("#gxgEstudiante option:selected").each(function () {

                gxgEstudiante=$(this).val();

                $.post("get_Estudiante.php", { gxgEstudiante: gxgEstudiante }, function(data){

                    $("#idUsuarioCitado").html(data);

                });        

            });

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