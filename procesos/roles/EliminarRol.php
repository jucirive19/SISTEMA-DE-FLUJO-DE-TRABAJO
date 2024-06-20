<?php
try {
    session_start();
    require_once "../../Clases/roles.php";
    $IdRol= new roles();
    $idrol = (int)$_POST['idrol'];
    echo $IdRol->eliminarrol($idrol);
} catch (\Throwable $th) {
    echo $th;
}
?>