<?php
try {
    session_start();
    require_once "../../../Clases/Editar.php";
    $IDUsuario = $_POST['IDUsuario'];

    $ACTusuario = new editar();
    $datosUsuario = $ACTusuario->ObtenerDatosUsuario($IDUsuario);
    
    // Ahora, obtenemos el rol del usuario
    $rolUsuario = $ACTusuario->ObtenerRolUsuario($IDUsuario);
    $datosUsuario['Rol'] = $rolUsuario;

    // Devolver los datos del usuario en formato JSON
    echo json_encode($datosUsuario);
} catch (\Throwable $th) {
    echo $th;
}
?>
