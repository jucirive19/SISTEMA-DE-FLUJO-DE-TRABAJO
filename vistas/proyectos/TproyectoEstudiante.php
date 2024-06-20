<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    require_once "../../Clases/usuario.php";
    ;
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    $conexion = $conexion->conexion();
    $idUsuario=$_SESSION['idusuario'];

    $idRolUsuario=new Usuario();
    $IdROlUser=$idRolUsuario->ObtenerIDusriorol($idUsuario);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="ProyectosEstudiante">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Nombre Director</th>
                        <th>Estado</th>
                        <th>Archivos</th>
                        <!--<th>NotaPropuesta</th> -->
                        <!--<th>Aprobar</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT proyecto.IDProyecto,propuesta.IDPropuesta,propuesta.Titulo, CONCAT(director.Nombre, ' ', director.Apellido) AS NombreDirector,
                            CASE proyecto.aprobado
                                WHEN 0 THEN 'A la espera'
                                WHEN 1 THEN 'Aprobado'
                                ELSE 'Desconocido'
                            END AS Estado
                            FROM 
                                propuesta
                            INNER JOIN 
                                proyecto ON propuesta.IDPropuesta = proyecto.IDPropuesta
                            INNER JOIN 
                                usuariorol AS director_usuariorol ON proyecto.IDusuariorol = director_usuariorol.IDUsuariorol
                            INNER JOIN 
                                usuarios AS director ON director_usuariorol.IDusuario = director.IDUser
                            WHERE 
                                propuesta.IDUserRol = $IdROlUser";
                    $result = mysqli_query($conexion, $sql);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($conexion));
                    }
                    while ($mostrar = mysqli_fetch_array($result)) {
                        $IDProyecto = $mostrar['IDProyecto'];
                    ?>
                        <tr>
                            <td><?php echo $mostrar['Titulo'] ?></td>
                            <td><?php echo $mostrar['NombreDirector'] ?></td>
                            <td><?php echo $mostrar['Estado'] ?></td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalSubirlibro"
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
    $('#ProyectosEstudiante' ).DataTable();
    });
</script>