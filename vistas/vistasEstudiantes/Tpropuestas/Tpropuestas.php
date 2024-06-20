<?php
    session_start();
    require_once "../../../Clases/Conexion.php";
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    $IDUsuario=$_SESSION['idusuario'];
    $NuDocumento=$_SESSION['NDocuemnto'];
    
    $conexion = $conexion->conexion();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="PropuestasDatatable">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Integrantes CC</th>
                        <th>Fecha</th>
                        <th>Archivos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT propuesta.Titulo, propuesta.Fecha, propuesta.IDPropuesta, usuarios.Ndocumento 
                            FROM propuesta 
                            INNER JOIN usuariorol ON propuesta.IDUserRol = usuariorol.IDUsuariorol 
                            INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser 
                            WHERE usuarios.IDUser = $IDUsuario ";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
                    $num_rows = mysqli_num_rows($result);
                    if ($num_rows == 0) {
                        // Realiza una segunda consulta utilizando el número de CC del usuario
                        $sql_cc = "SELECT propuesta.Titulo, propuesta.Fecha, propuesta.IDPropuesta, usuarios.Ndocumento 
                                FROM propuesta 
                                INNER JOIN usuariorol ON propuesta.IDUserRol = usuariorol.IDUsuariorol 
                                INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser 
                                WHERE propuesta.IntegrantesDos = '$NuDocumento' ";
                        $result_cc = mysqli_query($conexion, $sql_cc);
                        if (!$result_cc) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }
                        // Verifica si la segunda consulta devuelve resultados
                        $num_rows_cc = mysqli_num_rows($result_cc);
                        if ($num_rows_cc > 0) {
                            // Mostrar resultados de la segunda consulta
                            while ($mostrar_cc = mysqli_fetch_array($result_cc)) {
                                $IDPropuesta = $mostrar_cc['IDPropuesta'];
                    ?>
                                <tr>
                                    <td><?php echo $mostrar_cc['Titulo'] ?></td>
                                    <td><?php echo $mostrar_cc['Ndocumento'] ?></td>
                                    <td><?php echo $mostrar_cc['Fecha'] ?></td>
                                    <td>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#VisaulisarPropuesta"
                                            onclick="ObtenerDatosPropuesta(<?php print($IDPropuesta); ?>)">
                                            <span class="fa-solid fa-folder"></span>
                                        </button>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "No se encontraron propuestas asociadas al usuario.";
                        }
                    } else {
                        // Mostrar resultados de la primera consulta
                        while ($mostrar = mysqli_fetch_array($result)) {
                            $IDPropuesta = $mostrar['IDPropuesta'];
                    ?>
                            <tr>
                                <td><?php echo $mostrar['Titulo'] ?></td>
                                <td><?php echo $mostrar['Ndocumento'] ?></td>
                                <td><?php echo $mostrar['Fecha'] ?></td>
                                <td>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#VisaulisarPropuesta"
                                        onclick="ObtenerDatosPropuesta(<?php print($IDPropuesta); ?>)">
                                        <span class="fa-solid fa-folder"></span>
                                    </button>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Visualizar Propuesta -->
<div class="modal fade" id="VisaulisarPropuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualizar Propuesta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmVistaPropuesta">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="tituloVista" name="titulo"  disabled>
                    </div>
                    <div class="mb-3">
                        <label for="resumen" class="form-label">Resumen:</label>
                        <textarea class="form-control" id="resumenVista" name="resumen" rows="4" disabled></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="palabras_clave" class="form-label">Palabras Clave:</label>
                        <textarea name="palabras_clave"class="form-control" id="palabras_claveVista" name="palabras_clave" rows="2" disabled></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Propuesta</button>
            </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
    $('#PropuestasDatatable' ).DataTable();
    });
</script>