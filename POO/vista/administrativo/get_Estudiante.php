<?php
require_once("../../controlador/ControladorCita.php");
$ControladorCita = new ControladorCita();
$html="";
$q=$_POST['gxgEstudiante'];

 $listarEstudiantes = $ControladorCita->listarEstudiantes($q);
#$res=mysql_query("select * from pais where cod_cont=".$q."",$con);
foreach ($listarEstudiantes as $fila) {
$html = '<option value='.$fila["idUsuario"].'>'.$fila["Estudiante"].'</option>'; 
echo $html;
}
?>