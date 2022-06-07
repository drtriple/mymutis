<?php 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= docentes.xls");
echo "<head><meta charset='utf-8'></head>";

require_once("../../controlador/ControladorUsuario.php");

$ControladorUsuario = new ControladorUsuario();
//listas
$docentes = $ControladorUsuario->listarDocentes();
?>

<table class="table table-bordered">
                        <thead>
                            <tr>                    
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">ASIGNATURA/S</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">LÍDER DE GRUPO</th>
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
        
                            </tr>
                          
                            
                        </tbody>


                        <?php
                    }
                ?>
                        </table>