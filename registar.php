<?php
require_once 'Clases/roles.php';
require_once 'Clases/programas.php';
// Crear una instancia de la clase Rol
$rolDocente = new roles();
// Obtener los roles desde la base de datos
$rolesDoc = $rolDocente->obtenerRoles();
// Obtener los programas desde la base de datos
$programaDocente=new programas();
$ProgramasDoc=$programaDocente->obtenerProgramas();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<link rel="stylesheet" href="css/login.css">-->
    <link rel="stylesheet" href="librerias/Bootstrap/bootstrap.min.css"> 
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Registro de usuario</h1>
        <hr>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form Id="frmRegistro" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="NuevoNombreUsuario">Nombre:</label>
                    <input type="text" id="NuevoNombreUsuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="NuevoApellidoUsuario">Apellido:</label>
                    <input type="text" id="NuevoApellidoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoNdocumentoUsuario">#Documento:</label>
                    <input type="number" id="NuevoNdocumentoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoNtelefonoUsuario">#Telefono:</label>
                    <input type="number" id="NuevoNtelefonoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="NuevoCorreoUsuario">Email:</label>
                    <input type="email" id="NuevoCorreoUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="ContraseñaUsuario">Contraseña:</label>
                    <input type="password" id="ContraseñaUsuario" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="ContraseñaUsuario">Fecha De Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" class="form-control"required>
                </div>
                <div class="form-group">
                    <label for="programaSelect">Programa:</label>
                    <select id="programaSelect" class="form-control">
                        <option value="">Selecciona un programa</option>
                        <?php
                        foreach ($ProgramasDoc as $IDprograma => $Nombre) {
                            echo "<option value='$IDprograma'>$Nombre</option>";
                        }
                        ?>
                    </select>
                </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                        <button type="button" class="btn btn-primary" id="btnAgregarUsuario">Resgistratte</button>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="index.php" class="btn btn-success">Login</a>
                        </div>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
    <script src="librerias/jQuery/jquery-3.7.1.min.js"></script>
    <script src="librerias/sweetalert/sweetalert.min.js"></script>
    <script src="js/usuarios.js"></script>
    <script type="text/javascript">
    $ (document) .ready (function(){
        $('#btnAgregarUsuario').click(function(){
            Nuevousuario();
        });
    });
</script>   <!-- -->
    <script>
    // Obtener la fecha actual
    var fechaActual = new Date().toISOString().split('T')[0];

    // Establecer el atributo 'min' del campo de fecha
    document.getElementById("fecha_nacimiento").setAttribute("max", fechaActual);
    </script>




    
</body>
</html>

