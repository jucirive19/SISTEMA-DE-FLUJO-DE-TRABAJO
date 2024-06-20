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
        <h1 class="display-4">Docentes</h1>
        <div class="row">
                <div class="col-sm-4">
                    <!--
                    <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalNuevoDocente" >
                        <span class="fa-solid fa-circle-plus"></span> Agregar nuevo Docenete
                    </span>
                    -->   
                </div>
            </div>
            <hr>
        <div id="TablaDocentes"></div> <!---->   
    </div>
    </div>
    <!-- Modal Nuevo Docente 
    <div class="modal fade" id="ModalNuevoDocente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Docente</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="post" id="frmDocentes">
                <p1>Nombre</p1><br>
                <input type="text" id="NuevoNombreUsuario" class="fadeIn second"   >
                <br><p1>Apellido</p1><br>
                <input type="text" id="NuevoApellidoUsuario" class="fadeIn second" >
                <br><p1>#Documento</p1><br>
                <input type="number" id="NuevoNdocumentoUsuario" class="fadeIn second"  >
                <br><p1>#Telefono</p1><br>
                <input type="number" id="NuevoNtelefonoUsuario" class="fadeIn second"  >
                <br><p1>Email</p1><br>
                <input type="email" id="NuevoCorreoUsuario" class="fadeIn second"  >
                <br><p1>Contraseña</p1><br>
                <input type="password" id="ContraseñaUasuario" class="fadeIn second"  >
                <br><p1>Rol</p1><br>
                <select id="rolesSelect">
                    <option value="">Selecciona un ro   l</option>
                    <?php
                    /*
                    // Iterar sobre el array de roles y generar las opciones del select
                    foreach ($roles as $idRol => $nombreRol) {
                        echo "<option value='$idRol'>$nombreRol</option>";
                    }*/
                    ?>
                </select>
                <br><p1>programa</p1><br>
                <select id="programaSelect">
                    <option value="">Selecciona un programa</option>
                    <?php
                     /*
                    // Iterar sobre el array de programas y generar las opciones del select
                    foreach ($Programas as $IDprograma => $Nombre) {
                        echo "<option value='$IDprograma'>$Nombre</option>";
                    } */    
                    ?>
                </select>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnAgregarDocente">Guardar Docente</button>
        </div>
        </div>
    </div>
    </div>
    -->
    
<?php 
    include "footer.php";
?>

<script src="../js/docentes.js"></script>
<script type="text/javascript">
    $ (document) .ready (function(){
        $('#TablaDocentes').load("docentes/Tdocentes.php");
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