<?php
session_start();
require_once "../../../Clases/Editar.php";
try {
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir un array para almacenar los datos
    $datosActualizados = array();

    // Recoger los datos del formulario y guardarlos en el array
    $datosActualizados['IDUsuario'] = $_POST['IDUsuario'];
    $datosActualizados['NuevoNombreDocente'] = $_POST['NuevoNombreDocente'];
    $datosActualizados['NuevoApellidoDocente'] = $_POST['NuevoApellidoDocente'];
    $datosActualizados['NuevoNdocumentoDocente'] = $_POST['NuevoNdocumentoDocente'];
    $datosActualizados['NuevotelefonoDocente'] = $_POST['NuevotelefonoDocente'];
    $datosActualizados['NuevoCorreoDocente'] = $_POST['NuevoCorreoDocente'];
    $datosActualizados['ContraseñaDocente'] = sha1($_POST['ContraseñaDocente']);
    $datosActualizados['RolSelect'] = $_POST['rolesSelect'];
    $datosActualizados['ProgramaSelect'] = $_POST['programaSelect'];

    //print_r($datosActualizados);

    
    $ACTDocente = new editar();
    echo $ACTDocente->ActualizarDocente($datosActualizados); 
}
} catch (\Throwable $th) {
    // Manejo de errores
    echo $th;
}