<?php
session_start();
require_once "../../../Clases/Propuestas.php";

try {
    $fecha = date('Y-m-d H:i:s');
    $idusuario = $_SESSION['usuario'];
    $titulo = $_POST['titulo'];
    $resumen = $_POST['resumen'];
    $palabras_clave = $_POST['palabras_clave'];
    $nombre_archivo = $_FILES['documento']['name'];
    $ruta_temporal = $_FILES['documento']['tmp_name'];

    $DatosPropuesta = array(
        "Titulo" => $titulo,
        "Resumen" => $resumen,
        "PalabrasClave" => $palabras_clave,
        "Fecha" => $fecha,
        "idusuario" => $idusuario
    );
    //var_dump($DatosPropuesta);
    $nuevoDocumento = new Propuesta();
    $DocumentoNuevo = $nuevoDocumento->NuevaPropuesta($DatosPropuesta, $nombre_archivo, $ruta_temporal);
    echo $DocumentoNuevo;
} catch (\Throwable $th) {
    echo $th;
}
?>
