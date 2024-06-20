function ObtenerDatosUsuario(IDUsuario) {
    IDUsuario = parseInt(IDUsuario, 10);
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
                $('#NuevoNombreUsuario').val(datosUsuario.Nombre);
                $('#NuevoApellidoUsuario').val(datosUsuario.Apellido);
                $('#NuevoNdocumentoUsuario').val(datosUsuario.Ndocumento);
                $('#NuevoNtelefonoUsuario').val(datosUsuario.Ntelefono);
                $('#NuevoCorreoUsuario').val(datosUsuario.Correo);
                $('#NuevoFechaNacimientoUsuario').val(datosUsuario.FechaNacimiento);

                // Nuevo: Llenar el campo de entrada del nombre del rol
                $('#NombreRolUsuario').val(datosUsuario.Rol);
            }
        });
    }
}

function Nuevousuario(){
    var isEmpty = false;
    var inputs = $('#frmRegistro input');
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
    var datosNuevoEstudiante = {
        'ContraseñaUsuario': $('#ContraseñaUsuario').val(),
        'NuevoNombreUsuario': $('#NuevoNombreUsuario').val(),
        'NuevoApellidoUsuario': $('#NuevoApellidoUsuario').val(),
        'NuevoNdocumentoUsuario': $('#NuevoNdocumentoUsuario').val(),
        'NuevoNtelefonoUsuario': $('#NuevoNtelefonoUsuario').val(),
        'NuevoCorreoUsuario': $('#NuevoCorreoUsuario').val(),
        'fecha_nacimiento':$('#fecha_nacimiento').val(),
        'programaSelect': $('#programaSelect').val()
        
    };
    // Verificar si se ha seleccionado un rol y un programa
    if (!datosNuevoEstudiante['programaSelect']) {
        swal("(⌐■_■)", "También es obligatorio seleccionar un programa, por favor escoja uno.", "warning");
        return;
    }
    // Verificar si la contraseña no está vacía y tiene una longitud máxima de 16 caracteres
    if (datosNuevoEstudiante['ContraseñaUsuario'].length > 16) {
        swal("(▀̿ĺ̯▀̿ ̿)ᕗ", "La contraseña no puede tener más de 16 caracteres.", "warning");
        return;
    }
     // Realizar la petición AJAX para agregar el nuevo docente
    $.ajax({
        type: "POST",
        url: "procesos/usuarios/registro/registro.php",
        data: datosNuevoEstudiante,
        success: function(respuesta){
            respuesta = respuesta.trim();
            if (respuesta === "Exito") {
                swal("╲⎝⧹ ( ͡° ͜ʖ ͡°) ⎠╱", "Agregado con éxito!", "success");
                // Limpiar el formulario después de enviar los datos
                //$('#frmDocentes')[0].reset();
            } else {
                console.log(respuesta);
                swal(":(", "Fallo al agregar!\n Posiblemente el correo ya existe", "error");
            }
        }
    });
}
