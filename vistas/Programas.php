<?php
session_start();
// Incluye el archivo que contiene la función login
// Verifica si la variable de sesión está definida
if (isset($_SESSION['usuario'])) {
    include "header.php";
?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Propuestas</h1>
        <div class="row">
                <div class="col-sm-4">
                    <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalNuevoPrograma" >
                        <span class="fa-solid fa-circle-plus"></span> Agregar nuevo Programa
                    </span>
                </div>
            </div>
            <hr>
        <div id="tablaProgrmas"></div>
    </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="ModalNuevoPrograma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">agrega nuevo prorama</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="frmRol" method="post">
                <leabel>Nuevo Rol</leabel>
                <br>
                <br>
                <input type="text" id="NombreRol" class="fadeIn second" name="NombreRol" placeholder="Programa" required="">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary"id="btnAgrgarRol">Agregar</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ActualizarRol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Actulizar Rol</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="frmActualizarRol" action="post">
            <leabel>Nuevo Nombre</leabel>
                <br>
                <br>
                <input type="text" id="NuevoNombreRol" class="fadeIn second" name="NuevoNombreRol" placeholder="Nombre" required="">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-warning" id="btnActualizarRol">Actualizar</button>
        </div>
        </div>
    </div>
    </div>



<?php 
    include "footer.php";
?>
<script src="../js/roles.js"></script>
<script type="text/javascript">
    $ (document) .ready (function(){
        $('#tablaProgrmas').load("programas/Tprograms.php");

        $('#btnAgrgarRol').click(function(){
            agrgarrol();
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