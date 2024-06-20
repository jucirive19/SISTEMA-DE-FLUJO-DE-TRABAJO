<?php 
session_start();
require_once "../../../Clases/Propuestas.php";
require_once "../../../Clases/usuario.php";

$idUsuario=$_SESSION['idusuario'];
$IDPropuesta = $_POST['IDPropuesta'];

$idRolUsuario=new Usuario();
$IdROlUser=$idRolUsuario->ObtenerIDusriorol($idUsuario);

$existenota = new Propuesta();
$ValidarSiTieneNota = $existenota->validarEvaluacion($IDPropuesta, $IdROlUser);
if ($ValidarSiTieneNota > 0) { // Cambio aquí, verifica si la calificación existe
    echo "existe";
} else {
    //print($ValidarSiTieneNota);
    echo "no_existe"; // Devuelve una cadena vacía si no hay calificación
}
?>