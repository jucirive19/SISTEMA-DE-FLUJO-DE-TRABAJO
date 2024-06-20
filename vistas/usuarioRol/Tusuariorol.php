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
            <table class="table table-hover table-dark" id="tusuariorol">
                <thead>
                    <tr style="text-align: center;">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ndocumento</th>
                        <th>Ntelefono</th>
                        <th>Correo</th>
                        <th>FechaNacimiento</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT 
                        usuarios.IDUser,
                        usuarios.Nombre,
                        usuarios.Apellido,
                        usuarios.Ndocumento,
                        usuarios.Ntelefono,
                        usuarios.Correo,
                        usuarios.Pasword,
                        usuarios.FechaNacimiento,
                        rol.NombreRol
                    FROM 
                        usuarios 
                    INNER JOIN 
                        usuariorol  ON usuarios.IDUser = usuariorol.IDusuario
                    INNER JOIN 
                        rol  ON usuariorol.IDrol = rol.IDRol;
                    ";
                        $result = mysqli_query($conexion, $sql);
                        if (!$result) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }
                        $result = mysqli_query($conexion, $sql);
                        while($mostrar = mysqli_fetch_array($result)){
                            $IDUsuario=$mostrar['IDUser'];
                            
                            
                    ?>
                    <tr style="text-align: center;">
                        <td><?php echo $mostrar['Nombre'] ?></td>
                        <td><?php echo $mostrar['Apellido'] ?></td>
                        <td><?php echo $mostrar['Ndocumento'] ?></td>
                        <td><?php echo $mostrar['Ntelefono'] ?></td>
                        <td><?php echo $mostrar['Correo'] ?></td>
                        <td><?php echo $mostrar['FechaNacimiento'] ?></td>
                        <td><?php echo $mostrar['NombreRol'] ?></td>
                        
                        <td>
                        <span class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#EditarUsuario"
                        onclick="ObtenerDatosUsuario(<?php echo $IDUsuario ?>)">
                                <span class="fas fa-edit"></span>
                            </span>
                        </td>
                        <td>
                        <span class="btn btn-danger btn-sm">
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
<!-- Modal Editarusuario -->
<div class="modal fade" id="EditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actulizar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="frmActualizarUsuario" action="post">
            <leabel>Actulize Datos Del Usuario</leabel>
                <br><p1>Nombre</p1><br>
                <input type="text" id="NuevoNombreUsuario" class="fadeIn second" name="NuevoNombreRol"  >
                <br><p1>Apellido</p1><br>
                <input type="text" id="NuevoApellidoUsuario" class="fadeIn second" name="NuevoNombreRol" >
                <br><p1>#Documento</p1><br>
                <input type="number" id="NuevoNdocumentoUsuario" class="fadeIn second" name="NuevoNombreRol" >
                <br><p1>#Telefono</p1><br>
                <input type="number" id="NuevoNtelefonoUsuario" class="fadeIn second" name="NuevoNombreRol" >
                <br><p1>Email</p1><br>
                <input type="email" id="NuevoCorreoUsuario" class="fadeIn second" name="NuevoNombreRol" >
                <br><p1>Fecha De Nacimiento</p1><br>
                <input type="date" id="NuevoFechaNacimientoUsuario" class="fadeIn second" name="NuevoNombreRol">
                <br><p1>Rol</p1><br>
                <input type="text" id="NombreRolUsuario" class="fadeIn second" name="NombreRolUsuario" disabled> 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-warning" id="btnActualizUsuario">Actualizar</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Segundo Modal para Selección de Rol -->
<div class="modal fade" id="modalRoles" tabindex="-1" aria-labelledby="modalRolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRolesLabel">Seleccionar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes listar los roles disponibles -->
                <ul>
                    <li>Rol 1</li>
                    <li>Rol 2</li>
                    <!-- Agrega aquí todos los roles disponibles -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSeleccionarRol">Seleccionar</button>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function(){
    $('#tusuariorol' ).DataTable();
    });

</script> 
