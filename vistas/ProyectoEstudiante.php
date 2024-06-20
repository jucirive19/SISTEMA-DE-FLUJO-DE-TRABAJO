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

?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Proyectos</h1>
        <div class="row">
                <div class="col-sm-4">
                    <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalSubirlibro" >
                        <span class="fa-solid fa-circle-plus"></span> Agregar nuevo libro
                    </span>
                </div>
            </div>
            <hr>
            <div id="TabalaProyestosEstudiante"></div>  <!-- -->
        </div>     
    </div>
    </div>

<?php include "footer.php"; ?>

<!-- Modal Asignar Correciones -->
<div class="modal fade" id="ModalSubirlibro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Correcciones</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="frmVisuaCorrecionesDirector">
                    <div class="mb-3">
                        <label for="correccionesVista" class="form-label">Correcciones:</label>
                        <textarea name="correcciones" class="form-control" id="correccionesVista" name="correcciones" rows="5" ></textarea>
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="AsignarCorreciones()">Asignar Correciones</button>
        </div>
        </div>
    </div>
</div>



<script src="../js/proyecto.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaProyestosEstudiante').load("proyectos/TproyectoEstudiante.php");
    });
    
</script>
<?php
    }else{
        header("location:../index.php");
    }
?>