<?php

session_start();
require_once "../../../Clases/Propuestas.php";
require_once "../../../Clases/usuario.php";

$idUsuario=$_SESSION['idusuario'];
$IDPropuesta = $_POST['IDPropuesta'];

$idRolUsuario=new Usuario();
$IdROlUser=$idRolUsuario->ObtenerIDusriorol($idUsuario);

//echo "IDPropuesta: $IDPropuesta, IdROlUser: $IdROlUser\n"; // Agrega esto para verificar que los datos están llegando correctamente

$existenota = new Propuesta();
$ValidarSiTieneNota = $existenota->validarEvaluacion($IDPropuesta, $IdROlUser);

if ($ValidarSiTieneNota > 0) { // Cambio aquí, verifica si la calificación existe
    //echo "Entra al if :",$ValidarSiTieneNota ,"\n"; // Agrega esto para verificar que el flujo de control está llegando a esta parte del código
    $ObetnerCalificacion = new Propuesta();
    $Datoscalificacion = $ObetnerCalificacion->ObetnerCalificaciones($IDPropuesta, $IdROlUser);
    echo json_encode($Datoscalificacion);
} else {
    echo $ValidarSiTieneNota; // Devuelve una cadena vacía si no hay calificación
}

?>

