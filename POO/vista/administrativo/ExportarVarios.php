<?php 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= docentes.xls");
echo "<head><meta charset='utf-8'></head>";
require_once("../../controlador/ControladorUsuario.php");

$ControladorUsuario = new ControladorUsuario();
//listas
$varios = $ControladorUsuario->listarUsuarios();
?>

<table class="table table-bordered">
                        <thead>
                            <tr> 
                            <th scope="col">TIPO DOCUMENTO</th>                   
                            <th scope="col">DOCUMENTO</th>
                            <th scope="col">ROL</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDO</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">ESTADO</th>
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
                      </tr>
                          
                            
                        </tbody>

                        <?php
                    }
                ?>
                        </table>