<?php 
    session_start();
    if(isset($_SESSION[ 'usuario'])){

    include "headerEstudiante.php"; 

?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Propuestas</h1>
        <div id="TabalaPropuestas"></div>  <!---->
    </div>
    </div>

<?php include "footer.php"; ?>
<!---->
<script src="../../js/propuestas.js"></script>
<script type="text/javascript">
    $(document) .ready(function()
    {
        $('#TabalaPropuestas').load("Tpropuestas/Tpropuestas.php");
    });
</script>  
<?php
    }else{
        header("location:../index.php");
    }
?>