<?php 
    session_start();
    if(isset($_SESSION[ 'usuario'])){
        $rol = $_SESSION['rol'];

        switch($rol) {
            case 1:
                include "headerEstudiante.php";
                break;
            case 2:
                include "header.php";
                break;
            case 3:
                include "headerComite.php";
                break;
        }
        require_once '../Clases/usuario.php';
        $usuariosObj =new Usuario();
        $usuarios = $usuariosObj->obtenerUsuarios()

?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Proyectos</h1>
        <div id="TabalaProyestos"></div>  <!-- -->
    </div>
    </div>

<?php include "footer.php"; ?>

<!-- Modal Asignar Jurado -->
<div class="modal fade" id="ModalAsignarJurado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Jurado</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Agrega contenido aquí -->
            <form id="frmAsignarJurado">
            <div class="mb-3">
                <label for="jurado1" class="form-label">Jurado 1:</label>
                <select id="jurado1" name="jurado1" class="form-select">
                <option value="">Selecciona un usuario</option>
                <?php
                    foreach ($usuarios as $idUser => $nombreApellido) {
                    echo "<option value='$idUser'>$nombreApellido</option>";
                    }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jurado2" class="form-label">Jurado 2:</label>
                <select id="jurado2" name="jurado2" class="form-select">
                <option value="">Selecciona un usuario</option>
                <?php
                    foreach ($usuarios as $idUser => $nombreApellido) {
                    echo "<option value='$idUser'>$nombreApellido</option>";
                    }
                ?>
                </select>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AsignarJurado()">Asignar Jurado</button>
        </div>
        </div>
    </div>
</div>


<script src="../js/proyecto.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaProyestos').load("proyectos/Tproyectos.php");
    });
    
</script>
<?php
    }else{
        header("location:../index.php");
    }
?>