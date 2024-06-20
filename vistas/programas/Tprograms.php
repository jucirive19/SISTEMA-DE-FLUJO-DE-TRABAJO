<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    
    $conexion = $conexion->conexion();
?>
<div class= row >
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="Taprogramas">
                <thead>
                    <tr>
                        <th>Nombre</td>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT * FROM rol";
                        $result = mysqli_query($conexion, $sql);
                        while($mostrar = mysqli_fetch_array($result)){
                            $idrol = $mostrar["IDRol"]; 
                            $nombre=$mostrar["NombreRol"]
                            
                    ?>
                    <tr style="text-align: center;">
                        <td><?php echo $mostrar['NombreRol'] ?></td>
                        <td>
                            <span class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ActualizarRol"
                            onclick="ActualisarRol(<?php echo $idrol ?>)">
                                <span class="fas fa-edit"></span>
                            </span>
                        </td>
                        <td>
                            <span class="btn btn-danger btn-sm" onclick="eliminarRol( '<?php echo $idrol,$nombre ?>')">
                                <span class="fas fa-trash-alt"></span>
                            </span>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $('#Taprogramas' ).DataTable();
    });

</script> 