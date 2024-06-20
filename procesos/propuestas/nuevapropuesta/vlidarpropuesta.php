<?php
session_start();
require_once "../../../Clases/Propuestas.php";
require_once "../../../Clases/usuario.php";

$idUsuario = $_SESSION['idusuario'];
$NuDocumento = $_SESSION['NDocuemnto'];

$idRolUsuario = new Usuario();
$IdROlUser = $idRolUsuario->ObtenerIDusriorol($idUsuario);

$existePropuesta = new Propuesta();
$existePropuesta2= new Propuesta();

// Validar si el usuario tiene una propuesta asociada con su IDUserRol
$ValidarSiTienePropuesta = $existePropuesta->validarConIDUserRol($IdROlUser);
if ($ValidarSiTienePropuesta > 0) {
    //echo "existe por idusuario: ",$IdROlUser;
    echo "existe_usuario";
} else {
    // Validar si existe una propuesta asociada con el NuDocumento
    $ValidarSiTienePropuestaNdocumento = $existePropuesta2->validarConNuDocumento($NuDocumento);
    if ($ValidarSiTienePropuestaNdocumento > 0) {
        echo "existe_documento";
        //echo "existe por Ndocumento: ",$NuDocumento;
    } else {
        //echo "no_existeexiste por Ndocumento: ",$NuDocumento,'\ cantidade de propuestas: ', $ValidarSiTienePropuestaNdocumento; 
        echo "no_existe" ,$ValidarSiTienePropuesta,'\ ',$ValidarSiTienePropuestaNdocumento ,'\ ',$IdROlUser;
    }
}
?>
