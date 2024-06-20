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
        <h1 class="display-4">Propuestas</h1>
        <div id="TabalaPropuestas"></div>
    </div>
    </div>

<?php include "footer.php"; ?>

<!-- Modal Asignar Director -->
<div class="modal fade" id="ModalDirector" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Asignar Director</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Agrega contenido aquí -->
                <form id="frmDirector">
                    <p>Seleccione un director para la propuesta</p>
                    <select id="usuariosSelect" name="usuariosSelect">
                        <option value="">Selecciona un usuario</option>
                        <?php
                        foreach ($usuarios as $idUser => $nombreApellido) {
                            echo "<option value='$idUser'>$nombreApellido</option>";
                        }
                        ?>
                    </select>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"onclick="AsignarDirector()">Asignar Director</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/propuestas.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaPropuestas').load("gestor/propuestas.php");
    });
    
</script>
<?php
    }else{
        header("location:../index.php");
    }
?>
