<?php
session_start();
require_once "../../../Clases/usuario.php";
$Password = sha1($_POST['ContraseñaUsuario']);
$datosUsuario = array(
    "Nombre" => $_POST['NuevoNombreUsuario'],
    "Apellido" => $_POST['NuevoApellidoUsuario'],
    "Ndocumento" => $_POST['NuevoNdocumentoUsuario'],
    "Ntelefono" => $_POST['NuevoNtelefonoUsuario'],
    "Correo" => $_POST['NuevoCorreoUsuario'],
    "password" => $Password,
    "NombreRol"=>$_POST['rolesSelect'],
    "NombrePrograma"=>$_POST['programaSelect']
);
//print_r($datosUsuario);

$usuario = new Usuario();
$correo = $_POST['NuevoCorreoUsuario'];
if ($usuario->verificarCorreo($correo)) {
    echo "El correo ya existe en la base de datos.";
    exit(); // Detener la ejecución después de la redirección
} else {
    $DatosUsuario=$usuario->NuvoDocente($datosUsuario); 
    echo "Exito";
} 
?>
