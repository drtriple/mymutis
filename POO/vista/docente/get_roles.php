<?php
       require_once("../../controlador/controladorPregunta.php");
       $ControladorPregunta = new controladorPregunta();
$html="";
$q=$_POST['rolF'];

 $listarUsuarios = $ControladorPregunta->filtrarUsuarioR($q);

foreach ($listarUsuarios as $fila) {
$html = '<option value='.$fila['idUsuario'].'>'.$fila['Profesor'].'</option>'; 
echo $html;
}
?>