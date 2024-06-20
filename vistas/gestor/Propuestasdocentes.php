<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    
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
                        <!--<th>NotaPropuesta</th> -->
                        <th>NotaFinal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT propuesta.Titulo, propuesta.Fecha, propuesta.IDPropuesta, usuarios.Ndocumento, notafinal.Notafinal
                    FROM propuesta 
                    INNER JOIN usuariorol ON propuesta.IDUserRol = usuariorol.IDUsuariorol 
                    INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser
                    LEFT JOIN notafinal ON propuesta.IDPropuesta = notafinal.IDpropuesta
                    ";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
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
                            <td><?php echo $mostrar['Notafinal'] ?></td>
                            
                        </tr>
                    <?php
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
                <button type="button" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#CalificarPropuesta"onclick="ObtenerDatosCalificacion()">Calificar</button>
                <button class="btn btn-danger" data-bs-dismiss="modal" onclick="VisualisarDocumentoPropuestas()" target="_blank">Propuesta</button>

            </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Calificar Propuesta -->
<div class="modal fade" id="CalificarPropuesta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Calificacion de Propuesta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmCalificarPropuesta">
                    <div class="mb-3">
                        <label for="Pproblema" class="form-label">Planteamiento del problema: 1-20</label>
                        <input type="number" class="form-control" id="PlanteamientoProblema" name="PlanteamientoProblema" min="1" max="20" required oninput="validarLimite(this)"required>
                    </div>
                    <div class="mb-3"> 
                        <label for="E.D.A/M.terorioc" class="form-label">Estado del Arte Marco Teórico/Referentes Conceptuales: 1-20</label>
                        <input type="number" class="form-control" id="MarcoTeorico" name="MarcoTeorico" min="1" max="20" required oninput="validarLimite(this) " required>
                    </div>
                    <div class="mb-3">
                        <label for="Objetivos" class="form-label">Objetivos: 1-20</label>
                        <input  type="number" class="form-control" id="Objetivos" name="Objetivos" min="1" max="20" required oninput="validarLimite(this)"required >
                    </div>
                    <div class="mb-3">
                        <label for="Metodologia" class="form-label">Metodología: 1-20</label>
                        <input type="number" class="form-control" id="Metodologia" name="Metodologia" min="1" max="20" required oninput="validarLimite(this)" required>
                    </div>
                    <div class="mb-3">
                        <label for="G.P.academica" class="form-label">Grado de pertinencia académica: 1-10</label>
                        <input type="number" class="form-control" id="GradoPerteneciaAcademica" name="GradoPerteneciaAcademica" min="1" max="10" required oninput="validarLimite(this)"required>
                    <div class="mb-3">
                        <label for=">ImpactoyPertinencia" class="form-label">Impacto y Pertinencia: 1-5</label>
                        <input type="number" class="form-control" id="ImpactoPertenencia" name="ImpactoPertenencia" min="1" max="5" required oninput="validarLimite(this)"required>
                    </div>
                    <div class="mb-3">
                        <label for="Cronograma" class="form-label">Cronograma: 1-5</label>
                        <input type="number" class="form-control" id="Cronograma" name="Cronograma" min="1" max="5" required oninput="validarLimite(this)"required>
                    </div>
                    <div class="mb-3">
                        <label for="nota_final" class="form-label">Nota Final:</label>
                        <input type="text" class="form-control" id="notaFinalVista" name="nota_final" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="NotaPropuesta('<?php echo $IDPropuesta; ?>')">Calificar</button>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('#PropuestasDatatable' ).DataTable();
    });

    function validarLimite(input) {
        if (input.value > parseInt(input.getAttribute('max'))) {
            input.value = input.getAttribute('max'); // Si el valor es mayor que el máximo permitido, establecerlo en el máximo
        }
    }
</script>
