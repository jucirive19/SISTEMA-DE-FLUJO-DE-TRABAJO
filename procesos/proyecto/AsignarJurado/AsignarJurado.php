<?php
session_start();
require_once "../../../Clases/Proyecto.php";
require_once "../../../Clases/usuario.php";
try {
    $IDProyecto = $_POST['proyectoAcalificar'];
    $idUsuario = $_POST['jurado1'];
    $idUsuario2 = $_POST['jurado2'];
    //print_r($_POST);
    $idRolUsuario1=new Usuario();
    $IdROlUser=$idRolUsuario1->ObtenerIDusriorol($idUsuario);

    $AsignarProyecto= new proyecto();
    $AsignacionProyecto=$AsignarProyecto->Asigarjuado($IDProyecto,$IdROlUser);

    $idRolUsuario2=new Usuario();
    $IdROlUser=$idRolUsuario2->ObtenerIDusriorol($idUsuario2);

    $AsignarProyecto2= new proyecto();
    $AsignacionProyecto2=$AsignarProyecto2->Asigarjuado($IDProyecto,$IdROlUser);
    echo 1;

} catch (\Throwable $th) {
    echo $th;
}
?>