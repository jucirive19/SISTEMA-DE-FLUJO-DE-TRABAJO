function DocenteNuevo(){
    var isEmpty = false;
    var inputs = $('#frmDocentes input');
    inputs.each(function() {
        if (!$(this).val()) {
            isEmpty = true;
            return false; // Salir del bucle si se encuentra un campo vacío
        }
    });

    if (isEmpty) {
        swal("(⌐■_■)", "Todos los campos son obligatorios, por favor complete el formulario.", "warning");
        return false;
    }
    // Obtener los datos del formulario
    var datosNuevoDocente = {
        'ContraseñaUsuario': $('#ContraseñaUsuario').val(),
        'NuevoNombreUsuario': $('#NuevoNombreUsuario').val(),
        'NuevoApellidoUsuario': $('#NuevoApellidoUsuario').val(),
        'NuevoNdocumentoUsuario': $('#NuevoNdocumentoUsuario').val(),
        'NuevoNtelefonoUsuario': $('#NuevoNtelefonoUsuario').val(),
        'NuevoCorreoUsuario': $('#NuevoCorreoUsuario').val(),
        'rolesSelect': $('#rolesSelect').val(),
        'programaSelect': $('#programaSelect').val()
    };
    

    // Verificar si se ha seleccionado un rol y un programa
    if (!datosNuevoDocente['rolesSelect'] || !datosNuevoDocente['programaSelect']) {
        swal("(⌐■_■)", "También es obligatorio seleccionar un rol y un programa, por favor escoja uno.", "warning");
        return;
    }

    // Verificar si la contraseña no está vacía y tiene una longitud máxima de 16 caracteres
    if (datosNuevoDocente['ContraseñaUsuario'].length > 16) {
        swal("(▀̿ĺ̯▀̿ ̿)ᕗ", "La contraseña no puede tener más de 16 caracteres.", "warning");
        return;
    }

    // Realizar la petición AJAX para agregar el nuevo docente
    $.ajax({
        type: "POST",
        url: "../procesos/docentes/registro/registro.php",
        data: datosNuevoDocente,
        success: function(respuesta){
            respuesta = respuesta.trim();
            if (respuesta === "Exito") {
                swal("╲⎝⧹ ( ͡° ͜ʖ ͡°) ⎠╱", "Agregado con éxito!", "success");
                // Limpiar el formulario después de enviar los datos
                $('#frmDocentes')[0].reset();
            } else {
                console.log(respuesta);
                swal(":(", "Fallo al agregar!", "error");
            }
        }
    });
}

var idDocenteActual;

function ObtenerDatosDocente(IDUsuario){
    IDUsuario = parseInt(IDUsuario, 10);
    idDocenteActual=IDUsuario;
    swal("(╯ ͠° ͟ʖ ͡°)╯┻━┻", "Recuerda Si quieres hacer algun cambio es OBLIGATORIO cambiar tambien la contraseña", "warning");
    if (IDUsuario < 1) {
        swal("No tienes id de usuario!");
        return false;
    } else {
        $.ajax({
            type: "POST",
            data: { IDUsuario: IDUsuario },
            url: "../procesos/usuarios/actualizar/actualizar.php",
            success: function(respuesta) {
                respuesta = respuesta.trim();
                // Parsear la respuesta JSON
                var datosUsuario = JSON.parse(respuesta);
                // Llenar los campos del modal con los datos del usuario
                $('#NuevoNombreDocente').val(datosUsuario.Nombre);
                $('#NuevoApellidoDocente').val(datosUsuario.Apellido);
                $('#NuevoNdocumentoDocente').val(datosUsuario.Ndocumento);
                $('#NuevotelefonoDocente').val(datosUsuario.Ntelefono);
                $('#NuevoCorreoDocente').val(datosUsuario.Correo);
                $('#ContraseñaDocente').val(datosUsuario.Pasword);
            }
        });
    }
}

function ActualizarDocente() {
    // Recolectar los datos actualizados del formulario modal
    var IDUsuario = idDocenteActual;
    var datosActualizados = {
        'IDUsuario': IDUsuario,
        'NuevoNombreDocente': $('#NuevoNombreDocente').val(),
        'NuevoApellidoDocente': $('#NuevoApellidoDocente').val(),
        'NuevoNdocumentoDocente': $('#NuevoNdocumentoDocente').val(),
        'NuevotelefonoDocente': $('#NuevotelefonoDocente').val(),
        'NuevoCorreoDocente': $('#NuevoCorreoDocente').val(),
        'ContraseñaDocente': $('#ContraseñaDocente').val(),
        'rolesSelect': $('#rolesSelect').val(),
        'programaSelect': $('#programaSelect').val()
    };

    // Verificar si se ha seleccionado un rol y un programa
    if (!datosActualizados['rolesSelect'] || !datosActualizados['programaSelect']) {
        swal("(⌐■_■)", "También es obligatorio seleccionar un rol y un programa, por favor escoja uno.", "warning");
        return;
    }

    // Verificar la longitud de la contraseña
    if (datosActualizados['ContraseñaDocente'].length > 16) {
        console.log("rol y programa",datosActualizados['rolesSelect'],datosActualizados['programaSelect']);
        swal("(▀̿ĺ̯▀̿ ̿)ᕗ", "La contraseña no puede tener más de 16 caracteres.", "warning");
        return;
    }

    // Realizar la petición AJAX para actualizar el docente
    $.ajax({
        type: "POST",
        url: "../procesos/docentes/actualizar/actualizar.php",
        data: datosActualizados,
        success: function(respuesta) {
            // Procesar la respuesta del servidor   
            if (respuesta.trim() == "1") {
                console.log(respuesta);
                // Mostrar mensaje de éxito
                swal(":D", "¡Datos actualizados con éxito!", "success");
            } else {
                // Mostrar mensaje de error
                console.log(respuesta);
                swal(":(", "¡Fallo al actualizar los datos!", "error");
            }
        }
    });
}
