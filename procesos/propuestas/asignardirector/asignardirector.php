<?php
session_start();
require_once "../../../Clases/Proyecto.php";
require_once "../../../Clases/usuario.php";
try {
    $IDPropuesta = $_POST['IDPropuesta'];
    $idUsuario = $_POST['usuariosSelect'];
    //print_r($_POST);
    $idRolUsuario=new Usuario();
    $IdROlUser=$idRolUsuario->ObtenerIDusriorol($idUsuario);

    $Asiganrproyecto=new proyecto();
    $AsignacionProyecto=$Asiganrproyecto->asignarProyecto($IdROlUser,$IDPropuesta);
    echo 1;

} catch (\Throwable $th) {
    echo $th;
}
?>