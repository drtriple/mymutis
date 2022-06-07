<?php 
//error_reporting(0);
session_start();
if(isset($_SESSION['user'])){
  $logeado = $_SESSION['user'];

    require_once("../../controlador/ControladorUsuario.php");
    $ControladorUsuario = new ControladorUsuario();    
    $User = $ControladorUsuario->unUsuario($logeado);


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
    
    <title>My mutis | My Mutis</title>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
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
   <!--    <link rel="stylesheet" href="../../../vendor/sweetalert2/dist/sweetalert2.min.css">-->
 <!--   <script src="../../../vendor/sweetalert2/dist/sweetalert2.min.js"></script>-->

<style>

@import url("https://fonts.googleapis.com/css?family=Montserrat:400,400i,700");

.card-ID {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border-radius: 2rem;
  box-shadow: 0px 1rem 1.5rem rgba(0,0,0,0.5);
}
.card-ID .banner {
  background-image: url("../../../images/fondoCarnetOfi.png");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 11rem;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  box-sizing: border-box;
}
.card-ID .banner img {
  background-color: #fff;
  width: 8rem;
  height: 8rem;
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.3);
  border-radius: 50%;
  transform: translateY(50%);
  transition: transform 200ms cubic-bezier(0.18, 0.89, 0.32, 1.28);
}
.card-ID .banner img:hover {
  transform: translateY(50%) scale(1.3);
}
.card-ID .menu {
  width: 100%;
  height: 5.5rem;
  padding: 1rem;
  display: flex;
  align-items: flex-start;
  justify-content: flex-end;
  position: relative;
  box-sizing: border-box;
}
.card-ID .menu .opener {
  width: 2.5rem;
  height: 2.5rem;
  position: relative;
  border-radius: 50%;
  transition: background-color 100ms ease-in-out;
}
.card-ID .menu .opener:hover {
  background-color: #f2f2f2;
}
.card-ID .menu .opener span {
  background-color: #404040;
  width: 0.4rem;
  height: 0.4rem;
  position: absolute;
  top: 0;
  left: calc(50% - 0.2rem);
  border-radius: 50%;
}
.card-ID .menu .opener span:nth-child(1) {
  top: 0.45rem;
}
.card-ID .menu .opener span:nth-child(2) {
  top: 1.05rem;
}
.card-ID .menu .opener span:nth-child(3) {
  top: 1.65rem;
}
.card-ID h2.name {
  text-align: center;
  padding: 0 2rem 0.5rem;
  margin: 0;
}
.card-ID .title {
  color: #a0a0a0;
  font-size: 0.85rem;
  text-align: center;
  padding: 0 2rem 1.2rem;
}
.card-ID .actions {
  padding: 0 2rem 1.2rem;
  display: flex;
  flex-direction: column;
  order: 99;
}
.card-ID .actions .follow-info {
  padding: 0 0 1rem;
  display: flex;
}
.card-ID .actions .follow-info h2 {
  text-align: center;
  width: 50%;
  margin: 0;
  box-sizing: border-box;
}
.card-ID .actions .follow-info h2 a {
  text-decoration: none;
  padding: 0.8rem;
  display: flex;
  flex-direction: column;
  border-radius: 0.8rem;
  transition: background-color 100ms ease-in-out;
}
.card-ID .actions .follow-info h2 a span {
  color: #1c9eff;
  font-weight: bold;
  transform-origin: bottom;
  transform: scaleY(1.3);
  transition: color 100ms ease-in-out;
}
.card-ID .actions .follow-info h2 a small {
  color: #afafaf;
  font-size: 0.85rem;
  font-weight: normal;
}
.card-ID .actions .follow-info h2 a:hover {
  background-color: #f2f2f2;
}
.card-ID .actions .follow-info h2 a:hover span {
  color: #007ad6;
}
.card-ID .actions .follow-btn button {
  color: inherit;
  font: inherit;
  font-weight: bold;
  background-color: #ffd01a;
  width: 100%;
  border: none;
  padding: 1rem;
  outline: none;
  box-sizing: border-box;
  border-radius: 1.5rem/50%;
  transition: background-color 100ms ease-in-out, transform 200ms cubic-bezier(0.18, 0.89, 0.32, 1.28);
}
.card-ID .actions .follow-btn button:hover {
  background-color: #efb10a;
  transform: scale(1.1);
}
.card-ID .actions .follow-btn button:active {
  background-color: #e8a200;
  transform: scale(1);
}
.card-ID .desc {
  text-align: justify;
  padding: 0 2rem 2.5rem;
  order: 100;
}
</style>
    <script>

  function cambiarCarnet(){
    document.getElementById("carnet1").style.display="none";
    document.getElementById("carnet2").style.display="block";
  }
  function cambiarCarnet2(){
    document.getElementById("carnet2").style.display="none";
    document.getElementById("carnet1").style.display="block";
  }

    </script>
</head>

<body class="fix-header fix-sidebar card-no-border">

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">My mutis | My Mutis</p>
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
                               id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                               src="../../../images/fotosPerfil/<?php echo $image; ?>" alt="user" height="40"/> 
                                 
                                   <span class="hidden-md-down"><?php echo $logeado; ?> | <?php echo $User->getidRolUsuario() ?></span> 
                               
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-sm-right" aria-labelledby="navbarDarkDropdownMenuLink">  
                                  <li><a class="dropdown-item" href="mymutis.php"><i class="fa fa-id-badge fa-lg"></i>&nbsp; Carnet</a></li>
                               <li><a class="dropdown-item" href="mymutis.php?botonCerrar"><i class="fa fa-sign-in fa-lg"></i>&nbsp;Cerrar sesión</a></li>
                              
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
                        <h3 class="text-themecolor">My Mutis</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                            <li class="breadcrumb-item active">My Mutis</li>
                        </ol>
                    </div>
                </div>
            
            
                          <div class="card-ID" id="carnet1">
                  <div class="banner" onclick="cambiarCarnet()">
                    <img src="../../../images/fotosPerfil/<?php echo $image; ?>" alt="Profile image" />       
                  </div>
                  <div class="menu">
               
                  </div>
                  
                  <h2 class="name"><?php echo $User->getnombresUsuarios() ?> <?php echo $User->getapellidosUsuarios() ?> | <?php echo $User->getidRolUsuario(); ?><br> <?php echo $User->getdocUsuarios() ?></h2>
                  <div class="title">Correo Electrónico: <?php echo $User->getcorreoUsuarios() ?> </div>
                  <div class="actions">
                  <center>
                    <img data-value="<?php echo $User->getdocUsuarios() ?>" class="codigo" />
                    <hr style="color:#ff4d4d;">
                          </center>
                    <script>
                            JsBarcode(".codigo")
                            .options({
                            format: "CODE128",// El formato
                            displayValue: false,
                            background: "#FFFFFF", // Color de fondo
                           lineColor: "#000000", // Color de cada barra
                        }).init();
                            </script>
                   
                  </div>
                  
                  <div class="desc" style="text-align: center">Medellín, Antioquia - Colombia | Villa Hermosa -  Cl. 65 ## 45 - 15. <br>Institución Educativa José Celestino Mutis</div>
                </div>

                  <!-----CARNET DOS-->
                  <div class="card-ID" id="carnet2" style="display:none;">
                    <div class="banner" onclick="cambiarCarnet2()">
                      <img src="../../../images/fotosPerfil/<?php echo $image; ?>" alt="Profile image" />       
                    </div>
                    <div class="menu">                 
                    </div>
                
                    <div class="desc" style="text-align: center">Este carné es personal e intrasferible, identifica al portador como
                  Administrativo de la Institución Educativa Jose Celestino Mutis. La IE José Celestino Mutis es una 
                  institución de carácter público que brinda losservicios educativos en los niveles de preescolar, 
                  básica y media técnica yacadémica, a través de un enfoque socio cognitivo - constructivista.
                   Ofrece a sucomunidad una educación integral e incluyente donde la Ciencia, el Orden y elrespeto 
                   por los derechos humanos son pilares inspiradores de las nuevas generaciones.

                  </div>

                    <hr style="color:#ff4d4d;">
                    <div class="actions">
                    <center>
                      <img data-value="<?php echo $User->getdocUsuarios() ?>" class="codigo" />   
                      <h5>CELENYS CUESTA CAICEDO <br> RECTORA </h5>               
                            </center>
                      <script>
                              JsBarcode(".codigo")
                              .options({
                              format: "CODE128",// El formato
                              displayValue: false,
                              background: "#FFFFFF", // Color de fondo
                             lineColor: "#000000", // Color de cada barra
                          }).init();
                              </script>
                     
                    </div>       
                  </div>
  <!-----CARNET DOS FIN-->

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
      //header("Location:https://mymutis.000webhostapp.com/");
}
?>