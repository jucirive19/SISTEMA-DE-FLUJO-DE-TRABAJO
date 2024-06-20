<?php
session_start();
require_once "../../Clases/usuario.php";

try {
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    
    $usuario = new Usuario();
    $idRol = $usuario->verificarUsuario($correo, $password);
    /*
    try {
        $idRol = $usuario->verificarUsuario($correo, $password);
        
        if ($idRol !== false) {
            // Dependiendo del ID de rol, redirigir a la página correspondiente
            switch ($idRol) {
                case 1:
                    header("Location: ../../vistas/inicio.php");
                    break;
                case 2:
                    header("Location: vistas/InicioDocente.php");
                    break;
                default:
                    // Redirigir a una página de error o a la página principal
                    header("Location: index.php");
                    break;
            }
            exit;
        } else {
            echo "Error: Usuario o contraseña incorrectos.";
        }
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }*/
} catch (\Throwable $th) {
    echo "Error: " . $th->getMessage();
}
?>
