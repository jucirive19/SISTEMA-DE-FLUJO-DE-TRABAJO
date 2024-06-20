<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    ;
    $idUsuario = $_SESSION['usuario'];
    $IDUsuario=$_SESSION['idusuario'];
    $conexion = new Conectar();
    
    $conexion = $conexion->conexion();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="ProyectosDatatableDocente">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Archivos</th>
                        <!--<th>NotaPropuesta</th> -->
                        <!--<th>Aprobar</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT proyecto.IDProyecto, propuesta.Titulo, propuesta.Resumen, 
                            CASE proyecto.aprobado 
                                WHEN 0 THEN 'A la espera' 
                                WHEN 1 THEN 'Aprobado' 
                                ELSE 'Desconocido' 
                            END AS Estado
                            FROM proyecto
                            INNER JOIN usuariorol ON proyecto.IDusuariorol = usuariorol.IDUsuariorol
                            INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser
                            INNER JOIN propuesta ON proyecto.IDPropuesta = propuesta.IDPropuesta
                            WHERE usuarios.IDUser = $IDUsuario";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
                    while ($mostrar = mysqli_fetch_array($result)) {
                        $IDProyecto = $mostrar['IDProyecto'];
                    ?>
                        <tr>
                            <td><?php echo $mostrar['Titulo'] ?></td>
                            <td><?php echo $mostrar['Estado'] ?></td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAsignarCorreciones"
                                onclick="ObtenerDatosProyecto(<?php print($IDProyecto); ?>)">
                                    <span class="fa-solid fa-street-view"></span>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $('#ProyectosDatatableDocente' ).DataTable();
    });
</script>