<?php
    session_start();
    require_once "../../Clases/Conexion.php";
    require_once '../../Clases/roles.php';
    require_once '../../Clases/programas.php';
    $idUsuario = $_SESSION['usuario'];
    $conexion = new Conectar();
    $conexion = $conexion->conexion();
    
    $rol = new roles();
    // Obtener los roles desde la base de datos
    $roles = $rol->obtenerRoles();
    // Obtener los programas desde la base de datos
    $programa=new programas();
    $Programas=$programa->obtenerProgramas();
    
?>
<div class= row >
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-dark" id="Tdocentes">
                <thead>
                    <tr style="text-align: center;">
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Ndocumento</th>
                        <th>Ntelefono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT usuarios.IDUser, usuarios.Nombre, usuarios.Apellido, usuarios.Ndocumento, usuarios.Ntelefono, usuarios.Correo, usuarios.Pasword, rol.NombreRol
                        FROM usuarios 
                        INNER JOIN usuariorol ON usuarios.IDUser = usuariorol.IDusuario
                        INNER JOIN rol ON usuariorol.IDrol = rol.idrol
                        WHERE rol.idrol != 1";
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
                        <td><?php echo $mostrar['NombreRol'] ?></td>
                        
                        <td>
                        <span class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#DatosDocentes"
                        onclick="ObtenerDatosDocente(<?php echo $IDUsuario ?>)">
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

<!-- ModalEditarDocente-->
<div class="modal fade" id="DatosDocentes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" id="frmActulizacionDocente">
            <p1>Nombre</p1><br>
                <input type="text" id="NuevoNombreDocente" class="fadeIn second"   >
                <br><p1>Apellido</p1><br>
                <input type="text" id="NuevoApellidoDocente" class="fadeIn second" >
                <br><p1>#Documento</p1><br>
                <input type="number" id="NuevoNdocumentoDocente" class="fadeIn second"  >
                <br><p1>#Telefono</p1><br>
                <input type="number" id="NuevotelefonoDocente" class="fadeIn second"  >
                <br><p1>Email</p1><br>
                <input type="email" id="NuevoCorreoDocente" class="fadeIn second"  >
                <br><p1>Contraseña</p1><br>
                <input type="password" id="ContraseñaDocente" class="fadeIn second"  >
                <br><p1>Rol</p1><br>
                <select id="rolesSelect">
                    <option value="">Selecciona un rol</option>
                    <?php
                    // Iterar sobre el array de roles y generar las opciones del select
                    foreach ($roles as $idRol => $nombreRol) {
                        echo "<option value='$idRol'>$nombreRol</option>";
                    }
                    ?>
                </select>
                <br><p1>programa</p1><br>
                <select id="programaSelect">
                    <option value="">Selecciona un programa</option>
                    <?php
                    // Iterar sobre el array de roles y generar las opciones del select
                    foreach ($Programas as $IDprogrma => $Nombre) {
                        echo "<option value='$IDprogrma'>$Nombre</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="ActualizarDocente()">Guardar Cambios</button>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('#Tdocentes' ).DataTable();
    });

</script> 