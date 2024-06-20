<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="librerias/Bootstrap/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="librerias/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="librerias/jQuery/jquery-3.7.1.min.js">
</head>
<body> 
        <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">

            <img src="imagen/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form id="frmlogin" method="post" onsubmit="return logeo()" >
                <input type="text" id="correo" class="fadeIn second" name="correo" placeholder="correo" required="">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required="">
                <input type="submit" class="fadeIn fourth" value="Iniciar Sesión">
            </form>
            <!--<div id="respuesta"></div> -->
            <!-- Remind Passowrd -->
            <div id="formFooter">
            <a class="underlineHover" href="registar.php">registrate</a>
            </div>

        </div>
        </div>
        <script src="librerias/jQuery/jquery-3.7.1.min.js"></script>
        <script src="librerias/sweetalert/sweetalert.min.js"></script>
        <script type="text/javascript">
        function logeo() {
            $.ajax({
                method: "POST",
                data: $('#frmlogin').serialize(),
                url: "procesos/usuarios/login.php",
                success: function(respuesta) {
                $("#respuesta").html(respuesta);
                console.log(respuesta);

                switch(respuesta.trim()) {
                    case '1':
                        window.location.href = "vistas/InicoEstudiantes.php";
                        break;
                    case '2':
                        window.location.href = "vistas/inicio.php";
                        break;
                    case '3':
                        window.location.href = "vistas/inicioComite.php";
                        break;
                    default:
                        console.log(respuesta);
                        console.log("Opción inválida.");
                        swal("(° ͜ʖ °)", "Lo siento correo o contraseña no coinciden.", "warning");
                }
                    /*
                    if (respuesta == '1') {
                        console.log(respuesta);
                        swal("(°-°)", "bienvenido", "success")
                    } else {
                        console.log(respuesta);
                        swal(":X", "No se pudo iniciar sesión", "error");
                    }*/
                }
            });
            return false; // Para evitar que el formulario se envíe normalmente
        }
    </script> 
        

</body>


</html>