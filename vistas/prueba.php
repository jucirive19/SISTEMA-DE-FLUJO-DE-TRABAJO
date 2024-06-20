<?php
require_once '../Clases/roles.php';
require_once '../Clases/usuario.php';
$usuariosObj =new Usuario();
$usuarios = $usuariosObj->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Nombre</title>
</head>
<body>
    <h2>Selecciona un Nombre:</h2>
    <select id="usuariosSelect">
    <option value="">Selecciona un usuario</option>
    <?php
    foreach ($usuarios as $idUser => $nombreApellido) {
        echo "<option value='$idUser'>$nombreApellido</option>";
    }
    ?>
</select>
</body>
</html>

