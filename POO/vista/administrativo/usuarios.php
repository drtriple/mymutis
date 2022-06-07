<?php 
error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
    $logeado = $_SESSION['user'];
require_once("../../modelo/usuario.php");
require_once("../../controlador/ControladorUsuario.php");
require_once("../../controlador/ControladorGrupoxGradoxUsuario.php");
require_once("../../controlador/ControladorGrupoxGrado.php");
require_once("../../controlador/ControladorDocenteAsignatura.php");

$User = new Usuario();
$ControladorUsuario = new ControladorUsuario();
$Controladorgg = new ControladorGrupoxGradoxUsuario();
$Controladorda = new ControladorDocenteAsignatura();
$Controladorgxg = new ControladorGrupoxGrado();

//listas
$listargxg = $Controladorgxg->listarGG();
$estudiantes = $ControladorUsuario->listarEstudiantes();
$docentes = $ControladorUsuario->listarDocentes();
$varios = $ControladorUsuario->listarUsuarios();
$Use = $ControladorUsuario->unUsuario($logeado);

if(isset($_REQUEST['botonCerrar'])){
    session_unset();
    session_destroy();
    header("Location:../../../index.php");
}
//estudiante
else if(isset($_REQUEST['botonActualizarEstudiante'])){

    //actualizar correo PERSONAL
    if(empty($_REQUEST['emailModalEstudiante'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['emailModalEstudiante']) ){
         $ControladorUsuario->actualizarUsuarioCorreo($_REQUEST['userModalEstudiante'],$_REQUEST['emailModalEstudiante']);
         $mensajeActualizarEstudiante = "Actualización correcta";
         header("Location:usuarios.php");
    }
    else{
        $mensajeActualizarEstudiante = "Correo inválido, por favor ingrese uno valido";
    }

    //CORREO ACUDIENTE
    if(empty($_REQUEST['emailAcudienteModal'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['emailAcudienteModal']) ){
        $ControladorUsuario->actualizarUsuarioCorreoAcudiente($_REQUEST['userModalEstudiante'],$_REQUEST['emailAcudienteModal']);
        $mensajeActualizarEstudiante = "Actualización correcta";
        header("Location:usuarios.php");
   }
   else{
       $mensajeActualizarEstudiante = "Correo acudiente inválido, por favor ingrese uno valido";
   }

   //tipo DOCUMENTO
   if($_REQUEST['tipoDocEstudiante'] != 0 ){
    $ControladorUsuario->actualizarTipoDocumento($_REQUEST['userModalEstudiante'],$_REQUEST['tipoDocEstudiante']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
        }
        else{
        $mensajeActualizarEstudiante = "No hubo ningun cambio en tipo de documento";
        }

         //GRADO POR GRUPO
   if($_REQUEST['gxgEstudiante'] != 0 ){
    $Controladorgg->actualizarGrupoxGrado($_REQUEST['idModalIdEstudiante'],$_REQUEST['gxgEstudiante']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
        }
        else{
        $mensajeActualizarEstudiante = "No hubo ningun cambio en el grado del estudiante";
        }

          //ESTADO
   if($_REQUEST['estadoEstudiante'] != 0 ){
    $ControladorUsuario->actualizarEstado($_REQUEST['idModalIdEstudiante'],$_REQUEST['estadoEstudiante']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
        }
        else{
        $mensajeActualizarEstudiante = "No hubo ningun cambio en el estado";
        }
}
//filtrar estudiante
else if(isset($_REQUEST['btnFiltrar'])){
    $a = $_REQUEST['userFiltrarEstudiante'];
    $b = $_REQUEST['gxgEstudianteFiltrar'];
    header("Location:usuarios.php?documentoUsuario=$a&tipoGrupo=$b");
}
//Docente
else if(isset($_REQUEST['botonActualizarDocente'])){

//actualizar correo PERSONAL
if(empty($_REQUEST['emailModalDocente'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['emailModalDocente']) ){
    $ControladorUsuario->actualizarUsuarioCorreo($_REQUEST['userModalDocente'],$_REQUEST['emailModalDocente']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
}
else{
   $mensajeActualizarDocente = "Correo inválido, por favor ingrese uno valido";
}

    //GRADO POR GRUPO
if($_REQUEST['gxgDocente'] != 0 ){
$Controladorgg->actualizarGrupoxGrado($_REQUEST['idModalDocente'],$_REQUEST['gxgDocente']);
$mensajeActualizarEstudiante = "Actualización correcta";
header("Location:usuarios.php");
   }
   else{
    $mensajeActualizarDocente = "No hubo ningun cambio en el grado del estudiante";
   }

     //ESTADO
if($_REQUEST['estadoDocente'] != 0 ){
$ControladorUsuario->actualizarEstado($_REQUEST['idModalDocente'],$_REQUEST['estadoDocente']);
$mensajeActualizarEstudiante = "Actualización correcta";
header("Location:usuarios.php");
   }
   else{
    $mensajeActualizarDocente= "No hubo ningun cambio en el estado";
   }

   //ASIGNATURA
if($_REQUEST['asignaturaDocente'] != 0 ){
    $Controladorda->actualizarAsignatura($_REQUEST['idModalDocente'],$_REQUEST['asignaturaDocente'],$_REQUEST['asignaturaDocente2']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
       }
       else{
        $mensajeActualizarDocente= "No hubo ningun cambio en el estado";
       }

}
//Docente
else if(isset($_REQUEST['botonActualizarVarios'])){
    
    //actualizar correo PERSONAL
    if(empty($_REQUEST['emailModalVarios'])!=true && preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $_REQUEST['emailModalVarios']) ){
        $ControladorUsuario->actualizarUsuarioCorreo($_REQUEST['userModalVarios'],$_REQUEST['emailModalVarios']);
        $mensajeActualizarEstudiante = "Actualización correcta";
    }
    else{
    $mensajeActualizarDocente = "Correo inválido, por favor ingrese uno valido";
    }

 //ESTADO
 if($_REQUEST['estadoVarios'] != 0 ){
    $ControladorUsuario->actualizarEstado($_REQUEST['idModalVarios'],$_REQUEST['estadoVarios']);
    $mensajeActualizarEstudiante = "Actualización correcta";
    header("Location:usuarios.php");
       }
       else{
        $mensajeActualizarDocente= "No hubo ningun cambio en el estado";
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
    
    <title>My mutis | Usuarios</title>

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
 
 <style>
     #ocultarEstudiante1 {
display: none;
}
#ocultarEstudiante2 {
  display: none;
  }
  #ocultarDocente1{
    display: none;
  }
  #ocultarDocente2{
    display: none;
  }
#ocultarDocente3{
    display: none;
}
#ocultarVarios{
    display: none;
}
#ocultarVarios2{
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
                                  <li><a class="dropdown-item" href="perfil.php"><i class="fa fa-user-circle-o fa-lg"></i>&nbsp; Perfil</a></li>
                                  <li><a class="dropdown-item" href="mymutis.php"><i class="fa fa-id-badge fa-lg"></i>&nbsp; Carnet</a></li>
                               <li><a class="dropdown-item" href="usuarios.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
                              
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
                      
                        <li> <a class="waves-effect waves-dark" href="" aria-expanded="false"><i
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
                        <li> <a class="waves-effect waves-dark" href="CalendariodeEventos.php" aria-expanded="false"><i
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
                        <h3 class="text-themecolor">Usuarios</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>
                    </div>
                </div>

                <br>
                        <form>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <input type="text"
                            class="form-control" name="userFiltrarEstudiante" id="userFiltrarEstudiante" placeholder="Documento Estudiante">
                            </div><br><br>
                    
                            <div class="col-12 col-sm- 6 col-md-6 col-lg-4">
                                        <select class="form-select"  name="gxgEstudianteFiltrar" id="gxgEstudianteFiltrar">
                                            <option selected value="0">Grado y Grupo</option>
                                            <?php foreach ($listargxg as $ggFiltrar) {
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                                </div><br><br>

                            <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <button class="btn btn-dark" style="width:100%;" name="btnFiltrar">Filtrar</button>  
                        </div><br><br>
                            
                            <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                            <a href="ExportarEstudiante.php" style="width:100%;" class="btn btn-success" >Exportar Excel</a>
                            </div>
                        </div> 
                        </form>    
 
                      <br>

                <!---LISTA ESTUDIANTES---->
                <div class="row">
                
                <div class="col-lg-12 col-md-12">
           
                    <div class="card card-body">
                        <h5 class="card-title">ESTUDIANTES</h5>

                        
                        <table class="table table-bordered table-responsive" id="tablaEstudiante">
                        <thead>
                            <tr>
                            <th scope="col">TIPO DOCUMENTO</th>
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">CORREO ACUDIENTE</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">GRUPO</th>
                            <th scope="col">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
                $variableGETDoc = $_GET['documentoUsuario'];
                $variableGETGG = $_GET['tipoGrupo'];
                if($variableGETDoc != "" && $variableGETDoc != null && $variableGETGG == 0){
                    $estudiantes = $ControladorUsuario->listarEstudiantesFiltrar($variableGETDoc);
                }
                else if($variableGETGG != 0 && $variableGETGG != "" && $variableGETDoc == ""){
                    $estudiantes = $ControladorUsuario->listarEstudiantesFiltrarGradoxGrupo($variableGETGG);
                }
                else if($variableGETGG != 0 && $variableGETGG != "" && $variableGETDoc != ""){
                    $estudiantes = $ControladorUsuario->listarEstudiantesFiltrarggYDocumento($variableGETDoc,$variableGETGG);
                }
                else{
                //LISTAS
                $estudiantes = $ControladorUsuario->listarEstudiantes();                           
                   
                }

                            foreach($estudiantes as $e){ 
                            
                            ?>
                            <tr>
                         
                            <td><?php echo $e['descr']; ?></td>
                            <td><?php echo $e['docUsuario']; ?> </td>
                            <td><?php echo $e['nombresUsuario']; ?></td>
                            <td><?php echo $e['apellidosUsuario']; ?></td>
                            <td><?php echo $e['correoUsuario']; ?></td>
                            <td><?php echo $e['correoAcudiente']; ?></td>
                            <td><?php echo $e['estado']; ?></td>
                            <td><?php echo $e['grupo']; ?></td>
                <td><center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $e['idUsuario']; ?>">Actualizar</button></center></td>
                            </tr>
                          
      
                            <!-- Modal ESTUDIANTE-->
   <div class="modal fade" id="exampleModal<?php echo $e['idUsuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="usuarios.php" method="post">
                         <div class="row">

                         <div class="col-12 col-md-6 col-lg-6" id="ocultarEstudiante1">
                          <input type="text"
                            class="form-control" name="idModalIdEstudiante" id="idModalIdEstudiante" value="<?php echo $e['idUsuario']; ?>" >
                            </div>

                           <div class="col-12 col-md-6 col-lg-6" id="ocultarEstudiante2">
                          <input type="text"
                            class="form-control" name="userModalEstudiante" id="userModalEstudiante" value="<?php echo $e['docUsuario']; ?>" >
                            </div>

                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="nameModalEstudiante" class="form-label">Nombres:</label>
                            <input type="text"
                                     class="form-control" name="nameModalEstudiante" id="nameModalEstudiante" aria-describedby="helpId" value="<?php echo $e['nombresUsuario'];  ?> <?php echo $e['apellidosUsuario']; ?>" disabled>
                                </div>

                                </div>
                                <br>
                                <div class="row">

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="emailModalEstudiante" class="form-label">Correo:</label>
                                <input type="email"
                                class="form-control" name="emailModalEstudiante" id="emailModalEstudiante" aria-describedby="helpId" value="<?php echo $e['correoUsuario']; ?>">
                                </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="emailModal" class="form-label">Correo Acudiente:</label>
                                <input type="email"
                                class="form-control" name="emailAcudienteModal" id="emailAcudienteModal" aria-describedby="helpId" value="<?php echo $e['correoAcudiente']; ?>">
                                </div>

                                    </div>
                                  
                                        <br>
                                    <div class="row">

                               <div class="col-12 col-md-6 col-lg-6">
                                        <label for="tipoDoc" class="form-label">Tipo documento:</label>
                                        <select class="form-select"  name="tipoDocEstudiante" id="tipoDocEstudiante">
                                            <option selected value="0"><?php echo $e['descr']; ?></option>
                                            <option value="1">Registro Civil</option>
                                            <option value="2">Tarjeta de Identidad</option>
                                            <option value="3">Cédula de Ciudadanía</option>
                                            <option value="4">Cédula de extranjería</option>
                                            
                                          </select>
                                            </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="gxg" class="form-label">Grupo y grado:</label>
                                        <select class="form-select"  name="gxgEstudiante" id="gxgEstudiante">
                                            <option selected value="0"><?php echo $e['grupo']; ?></option>
                                            <?php foreach ($listargxg as $ggFiltrar) { 
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                        
                                          </select>
                                </div>
                                        </div>

                                        <div class="row">

                        <div class="col-12 col-md-12 col-lg-12">
                                <label for="tipoDoc" class="form-label">Estado:</label>
                                <select class="form-select"  name="estadoEstudiante" id="estadoEstudiante">
                                <option selected value="0">
                                <?php 
                                echo $e['estado'];
                                ?>
                                </option>
                                <?php if($e['estado'] == "Activo"){
                                                    ?>
                                                    <option value="2">Desactivado</option>
                                                    <?php
                                            }else{
                                                ?>
                                            <option value="1">Activado</option>  
                                                <?php
                                            }?> 
                                   
                                    
                                </select>
                                    </div>
                                    </div>

                                        <br>

                                        <p><?php 
                                    if(isset($mensajeActualizarEstudiante)){
                                    echo $mensajeActualizarEstudiante; }?></p>

                                  
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-success" name="botonActualizarEstudiante">Actualizar cambios</button>
                                  
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
                        </tbody>

                        </table>

                    </div>
                </div>
                </div> 

            <br>
             <!---LISTA DOCENTES---->
             <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-body">
                        <h5 class="card-title">DOCENTES</h5>
                        <a href="ExportarDocentes.php" class="btn btn-success" >Exportar Excel</a>
                      <br> <br>
                        <table class="table table-bordered table-responsive" id="tablaDocente">
                        <thead>
                            <tr>                    
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">ASIGNATURA/S</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">LÍDER DE GRUPO</th>
                            <th scope="col">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
                            foreach($docentes as $d){ 
                            
                            ?>
                            <tr>
                            <td><?php echo $d['docUsuario']; ?> </td>
                            <td><?php echo $d['nombresUsuario']; ?></td>
                            <td><?php echo $d['apellidosUsuario']; ?></td>
                            <td><?php echo $d['correoUsuario']; ?></td>
                            <td><?php echo $d['asignatura']; ?></td>
                            <td><?php echo $d['estado']; ?></td>
                            <td><?php echo $d['grupo']; ?></td>
                <td><center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDocente<?php echo $d['idDocenteAsignatura']; ?>">Actualizar</button></center></td>
                            </tr>
  
                               <!-- Modal DOCENTE-->
   <div class="modal fade" id="exampleModalDocente<?php echo $d['idDocenteAsignatura']; ?>" tabindex="-1" aria-labelledby="exampleModalLabelDocente" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelDocente">Actualizar Docente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="usuarios.php" method="POST">
                         <div class="row">

                         <div class="col-12 col-md-6 col-lg-6" id="ocultarDocente1">
                          <input type="text"
                            class="form-control" name="idModalDocente" id="idModalDocente" value="<?php echo $d['idUsuario']; ?>">
                            </div>

                           <div class="col-12 col-md-6 col-lg-6" id="ocultarDocente2">
                          <input type="text"
                            class="form-control" name="userModalDocente" id="userModalDocente" value="<?php echo $d['docUsuario']; ?>">
                            </div>

                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="nameModal" class="form-label">Nombres:</label>
                            <input type="text"
                                     class="form-control" name="nameModalDocente" id="nameModalDocente" aria-describedby="helpId" value="<?php echo $d['nombresUsuario']; ?> <?php echo $d['apellidosUsuario']; ?>" disabled>
                                </div>

                                    </div>
<br>
                                    <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                <label for="emailModal" class="form-label">Correo:</label>
                                <input type="email"
                                class="form-control" name="emailModalDocente" id="emailModalDocente" aria-describedby="helpId" value="<?php echo $d['correoUsuario']; ?>">
                                </div>
                                </div>
                                        <br>
                                    <div class="row">

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="estado" class="form-label">Estado:</label>
                                        <select class="form-select"  name="estadoDocente" id="estadoDocente">
                                            <option selected value="0"><?php echo $d['estado']; ?></option> 
                                            <?php if($d['estado'] == "Activo"){
                                                    ?>
                                                    <option value="2">Desactivado</option>
                                                    <?php
                                            }else{
                                                ?>
                                            <option value="1">Activado</option>  
                                                <?php
                                            }?>            
                                          </select>
                                </div>

                                <div class="col-12 col-md-6 col-lg-6">
                                <label for="gxg" class="form-label">Líder de grupo:</label>
                                        <select class="form-select"  name="gxgDocente" id="gxgDocente">
                                            <option selected value="0"><?php echo $d['grupo']; ?></option>
                                            <?php foreach ($listargxg as $ggFiltrar) {
                                                                                            ?>
                                            <option value="<?php echo $ggFiltrar['idGradoxGrupo']; ?>"><?php echo $ggFiltrar['descGrado']; ?> - <?php echo $ggFiltrar['descGrupo']; ?></option>
                                         <?php } ?>
                                          </select>
                                </div>
                                        </div>

                                        <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                <label for="asignatura2" class="form-label">Asignaturas:</label>
                                        <select class="form-select" id="asignaturaDocente" name="asignaturaDocente">
                                            <option selected value="0"><?php echo $d['asignatura']; ?> (Registrada)</option>
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

                                <div class="col-12 col-md-12 col-lg-12" id="ocultarDocente3">
                                        <select class="form-select" id="asignaturaDocente2" name="asignaturaDocente2">
                                            <option selected value="<?php echo $d['idDocenteAsignatura']; ?>">(Registrada)</option>    
                                          </select>
                                </div>
                                            </div>

                                        <br>

                                        <p><?php 
                                    if(isset($mensajeActualizarDocente)){
                                    echo $mensajeActualizarDocente; }?></p>

                                  
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-success" name="botonActualizarDocente">Guardar cambios</button>
                                  
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
  <!-- FIN Modal DOCENTE-->

  <?php
                    }
                ?>
                            
                        </tbody>
                        </table>

                    </div>
                </div>
            </div>
     
            <br>
            <!---LISTA INTERNO, ADMIN, SECRETARIO---->
            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-body">
                        <h5 class="card-title">INTERNO, ADMINISTRADORES, SECRETARIOS</h5>
                        <a href="ExportarVarios.php" class="btn btn-success" >Exportar Excel</a>
                      <br> <br>
                        <table class="table table-bordered table-responsive" id="tablaVarios">
                        <thead>
                            <tr> 
                            <th scope="col">TIPO DOCUMENTO</th>                   
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">ROL</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
                            foreach($varios as $v){ 
                            
                            ?>
                            <tr>
                            <td><?php echo $v['descr']; ?> </td>
                            <td><?php echo $v['docUsuario']; ?></td>
                            <td><?php echo $v['descripcionRol']; ?></td>
                            <td><?php echo $v['nombresUsuario']; ?></td>
                            <td><?php echo $v['apellidosUsuario']; ?></td>
                            <td><?php echo $v['correoUsuario']; ?></td>
                            <td><?php echo $v['estado']; ?></td>
                <td><center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $v['idUsuario']; ?>">Actualizar</button></center></td>
                            </tr>
                          
                            
   <!-- Modal INTERNO, ADMIN, SECRETARIO-->
   <div class="modal fade" id="exampleModal<?php echo $v['idUsuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="usuarios.php" method="POST">
                         <div class="row">

                         <div class="col-12 col-md-6 col-lg-6" id="ocultarVarios">
                          <input type="text"
                            class="form-control" name="idModalVarios" id="idModalVarios" value="<?php echo $v['idUsuario']; ?>">
                            </div>

        
                           <div class="col-12 col-md-6 col-lg-6" id="ocultarVarios2">
                          <input type="text"
                            class="form-control" name="userModalVarios" id="userModalVarios" value="<?php echo $v['docUsuario']; ?>">
                            </div>

                                <div class="col-12 col-md-12 col-lg-12">
                            <label for="nameModal" class="form-label">Nombre Completo:</label>
                            <input type="text"
                                     class="form-control" name="nameModalVarios" id="nameModalVarios" aria-describedby="helpId" value="<?php echo $v['nombresUsuario']; ?> <?php echo $v['apellidosUsuario']; ?>" disabled>
                                </div>  
                                    </div>

                                    <br>
                                    <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                <label for="emailModal" class="form-label">Correo:</label>
                                <input type="email"
                                class="form-control" name="emailModalVarios" id="emailModalVarios" aria-describedby="helpId" value="<?php echo $v['correoUsuario']; ?>">
                                </div>
                                    </div>
                                  
                                        <br>
                                    <div class="row">

                                <div class="col-12 col-md-12 col-lg-12">
                                <label for="estado" class="form-label">Estado:</label>
                                        <select class="form-select"  name="estadoVarios" id="estadoVarios">
                                            <option selected value="0"><?php echo $v['estado']; ?></option>
                                            <?php if($v['estado'] == "Activo"){
                                                    ?>
                                                    <option value="2">Desactivado</option>
                                                    <?php
                                            }else{
                                                ?>
                                            <option value="1">Activado</option>  
                                                <?php
                                            }?>          
                                          </select>
                                </div>

                                        </div>
                                        <br>

                                        <p><?php 
                                    if(isset($mensajeActualizarVarios)){
                                    echo $mensajeActualizarVarios; }?></p>

                                  
                                    <div class="col-auto">
                                        <center>
                                        <button type="submit" class="btn btn-success" name="botonActualizarVarios">Guardar cambios</button>
                                  
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
  <!-- FIN Modal INTERNO, ADMIN, SECRETARIO-->

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
    $('#tablaEstudiante').DataTable({
    "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
    });
    });

    $(document).ready(function() {
    $('#tablaDocente').DataTable({
    "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
    });
    });

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
     //header("Location:https://mymutis.000webhostapp.com/");
}
?>