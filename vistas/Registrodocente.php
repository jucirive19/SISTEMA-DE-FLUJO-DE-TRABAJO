<?php
session_start();
require_once '../Clases/roles.php';
require_once '../Clases/programas.php';
// Crear una instancia de la clase Rol
$rolDocente = new roles();
// Obtener los roles desde la base de datos
$rolesDoc = $rolDocente->obtenerRoles();
// Obtener los programas desde la base de datos
$programaDocente=new programas();
$ProgramasDoc=$programaDocente->obtenerProgramas();


if (isset($_SESSION['usuario'])) {
    include "header.php";
?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <form action="post" id="frmDocentes">
                <div class="form-group">
                    <label for="NuevoNombreUsuario">Nombre:</label>
                    <input type="text" id="NuevoNombreUsuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="NuevoApellidoUsuario">Apellido:</label>
                    <input type="text" id="NuevoApellidoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoNdocumentoUsuario">#Documento:</label>
                    <input type="number" id="NuevoNdocumentoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoNtelefonoUsuario">#Telefono:</label>
                    <input type="number" id="NuevoNtelefonoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoCorreoUsuario">Email:</label>
                    <input type="email" id="NuevoCorreoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="ContraseñaUsuario">Contraseña:</label>
                    <input type="password" id="ContraseñaUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="rolesSelect">Rol:</label>
                    <select id="rolesSelect" class="form-control">
                        <option value="">Selecciona un rol</option>
                        <?php
                        foreach ($rolesDoc as $idRol => $nombreRol) {
                            echo "<option value='$idRol'>$nombreRol</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="programaSelect">Programa:</label>
                    <select id="programaSelect" class="form-control">
                        <option value="">Selecciona un programa</option>
                        <?php
                        foreach ($ProgramasDoc as $IDprograma => $Nombre) {
                            echo "<option value='$IDprograma'>$Nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                <br>
                <button type="button" class="btn btn-primary" id="btnAgregarDocente">Guardar Docente</button>
            </form>
        </div>
    </div>
</div>

<?php 
    include "footer.php";
?>

<script src="../js/docentes.js"></script>
<script type="text/javascript">
    $ (document) .ready (function(){
        $('#btnAgregarDocente').click(function(){
            DocenteNuevo();
        });
    });
</script>

<?php 
} else {
    header("location:../registar.php");
    // Redirige al usuario a la página de inicio de sesión si la variable de sesión no está definida
    exit();
}
?>