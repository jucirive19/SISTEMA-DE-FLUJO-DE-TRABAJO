<?php
try {
    session_start();
    require_once "../../Clases/roles.php";
    $Rol=$_POST['NombreRol'];

    $Nrol= new roles();
    echo $Nrol->agregarrol($Rol);
} catch (\Throwable $th) {
    echo $th;
}
?>