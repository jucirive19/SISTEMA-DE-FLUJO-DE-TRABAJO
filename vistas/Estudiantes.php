<?php
session_start();
// Incluye el archivo que contiene la función login
// Verifica si la variable de sesión está definida
if (isset($_SESSION['usuario'])) {
    include "header.php";
?>
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Estudiantes</h1>
        <div class="row">
                <div class="col-sm-4">
                
                </div>
            </div>
            <hr>
        <div id="tablausuariorol"></div>
    </div>

    </div>


<?php 
    include "footer.php";
?>
<script src="../js/usuarios.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tablausuariorol').load("usuarioRol/Tusuariorol.php");
    
});
</script>
<?php
    }else{
        header("location:../index.php");
    }
?>