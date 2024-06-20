<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    ;
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    
    $conexion = $conexion->conexion();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="ProyectosDatatable">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Director</th>
                        <th>Estado</th>
                        <th>Archivos</th>
                        <!--<th>NotaPropuesta</th> -->
                        <!--<th>Aprobar</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT propuesta.IDPropuesta,proyecto.IDProyecto,
                            propuesta.Titulo,
                            CONCAT(usuarios.Nombre, ' ', usuarios.Apellido) AS Director,
                            CASE proyecto.Aprobado
                                WHEN 0 THEN 'A la espera'
                                WHEN 1 THEN 'Aprobado'
                                ELSE 'Desconocido'
                            END AS Estado
                            FROM proyecto
                            INNER JOIN propuesta ON proyecto.IDPropuesta = propuesta.IDPropuesta
                            INNER JOIN usuariorol ON proyecto.IDusuariorol = usuariorol.IDUsuariorol
                            INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
                    while ($mostrar = mysqli_fetch_array($result)) {
                        $IDProyecto = $mostrar['IDProyecto'];
                    ?>
                        <tr>
                            <td><?php echo $mostrar['Titulo'] ?></td>
                            <td><?php echo $mostrar['Director'] ?></td>
                            <td><?php echo $mostrar['Estado'] ?></td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAsignarJurado"
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
    $('#ProyectosDatatable' ).DataTable();
    });
</script>

