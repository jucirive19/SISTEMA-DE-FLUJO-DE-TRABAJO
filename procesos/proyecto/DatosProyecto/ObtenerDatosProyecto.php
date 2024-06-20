<?php
session_start();
require_once "../../../Clases/Proyecto.php";

try {
    $IDProyecto = $_POST['IDProyecto'];
    $ObtenerProyecto = new proyecto();
    $DatosProyecto = $ObtenerProyecto->ObtenerDatosProyecto($IDProyecto);
    echo json_encode($DatosProyecto);
} catch (Throwable $th) {
    echo $th;
}
?>