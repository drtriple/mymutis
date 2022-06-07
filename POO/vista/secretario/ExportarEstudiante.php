<?php 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= estudiantes.xls");
echo "<head><meta charset='utf-8'></head>";

require_once("../../controlador/ControladorUsuario.php");

$ControladorUsuario = new ControladorUsuario();

//listas
$estudiantes = $ControladorUsuario->listarEstudiantes();
?>

<table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">TIPO DOCUMENTO</th>
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">CORREO ACUDIENTE</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">GRUPO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php	
                            foreach($estudiantes as $e){ 
                            
                            ?>
                            <tr>
                            <th scope="row"><?php echo $e['idUsuario']; ?></th>
                            <td><?php echo $e['descr']; ?></td>
                            <td><?php echo $e['docUsuario']; ?> </td>
                            <td><?php echo $e['nombresUsuario']; ?></td>
                            <td><?php echo $e['apellidosUsuario']; ?></td>
                            <td><?php echo $e['correoUsuario']; ?></td>
                            <td><?php echo $e['correoAcudiente']; ?></td>
                            <td><?php echo $e['estado']; ?></td>
                            <td><?php echo $e['grupo']; ?></td>
              
                            </tr>
                          
                            
                        </tbody>

                        <?php
                    }
                ?>
                        </table>