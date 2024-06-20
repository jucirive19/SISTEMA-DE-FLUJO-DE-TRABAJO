<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    ;
    $idUsuario = $_SESSION['usuario'];
    $IDusuario=$_SESSION['idusuario'];
    $conexion = new Conectar();
    
    $conexion = $conexion->conexion();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="juradoDatatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Archivos</th>
                        <!--<th>NotaPropuesta</th> -->
                        <!--<th>Aprobar</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT proyecto.IDProyecto, propuesta.Titulo
                            FROM proyecto
                            INNER JOIN jurado ON proyecto.IDProyecto = jurado.IDProyecto
                            INNER JOIN usuariorol ON jurado.IDusuariorol = usuariorol.IDUsuariorol
                            INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser
                            INNER JOIN propuesta ON proyecto.IDPropuesta = propuesta.IDPropuesta
                            WHERE usuarios.IDUser = $IDusuario";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
                    while ($mostrar = mysqli_fetch_array($result)) {
                        $IDProyecto = $mostrar['IDProyecto'];
                    ?>
                        <tr>
                            <td><?php echo $mostrar['IDProyecto'] ?></td>
                            <td><?php echo $mostrar['Titulo'] ?></td>
                            
                            <td>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#visualizarProyecto"
                                onclick="cargarDatosProyecto(<?php print($IDProyecto); ?>)">
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
<!--Modal visualisar Proyecto -->
<div class="modal fade" id="visualizarProyecto" tabindex="-1" aria-labelledby="visualizarProyectoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visualizarProyectoLabel">Visualizar Proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmVisualProyecto">
                    <div class="mb-3">
                        <label for="tituloVista" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="tituloVista" name="titulo"  disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tituloVista" class="form-label">Director:</label>
                        <input type="text" class="form-control" id="DirectorVista" name="Director"  disabled>
                    </div>
                    <div class="mb-3">
                        <label for="resumenVista" class="form-label">Resumen:</label>
                        <textarea class="form-control" id="resumenVista" name="resumen" rows="4" disabled></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="correccionesVista" class="form-label">Correcciones:</label>
                        <textarea name="correcciones" class="form-control" id="correccionesVista" name="correcciones" rows="5" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="calificarLibro">Calificar Libro</button>
                <button type="button" class="btn btn-primary" id="calificarPresentacion">Calificar Presentación</button>
                <button type="button" class="btn btn-primary" id="calificarLibro">Libro</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('#juradoDatatable' ).DataTable();
    });
</script>