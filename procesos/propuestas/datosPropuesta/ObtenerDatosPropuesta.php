<?php
session_start();
require_once "../../../Clases/Propuestas.php";

try {
    $IDPropuesta = $_POST['IDPropuestas'];
    $ObtenerPropuesta = new Propuesta();
    $DatosPropuesta = $ObtenerPropuesta->ObtenerDatosPropuesta($IDPropuesta);

    // Devolver los datos de la propuesta en formato JSON
    echo json_encode($DatosPropuesta);
} catch (Throwable $th) {
    echo $th;
}
?>