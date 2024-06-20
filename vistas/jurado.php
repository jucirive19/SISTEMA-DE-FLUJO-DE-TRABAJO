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
        <h1 class="display-4">Jurado</h1>
        <div id="TabalaJurados"></div>  <!-- -->
    </div>
    </div>

<?php include "footer.php"; ?>

<script src="../js/proyecto.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaJurados').load("CalificacionProyecto/TcalificacionProyecto.php");
    });
    
</script>
<?php
    }else{
        header("location:../index.php");    
    }
?>