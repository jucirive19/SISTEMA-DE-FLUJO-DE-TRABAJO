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

?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Propuestas</h1>
        <div id="TabalaPropuestas"></div>  <!---->
    </div>
    </div>

<?php include "footer.php"; ?>
<!---->
<script src="../js/propuestas.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaPropuestas').load("gestor/Propuestasdocentes.php");
    });
</script>  
<?php
    }else{
        header("location:../index.php");
    }
?>