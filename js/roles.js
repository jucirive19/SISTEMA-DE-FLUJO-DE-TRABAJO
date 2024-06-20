function agrgarrol(){
    var categoria = $('#NombreRol').val();  
    if (categoria == "") {
        swal("Debes agregar una categoria");
        return false;
    } else {
        $.ajax({
            type: "POST",
            data: $('#frmRol').serialize(), // Aquí se serializa el formulario con id frmRol
            url: "../procesos/roles/agregarrol.php",
            success: function(respuesta){
                respuesta = respuesta.trim();
                if (respuesta == 1) {
                    $('#tablaProgrmas').load("../vistas/programas/Tprograms.php");
                    swal(":D", "Agregado con exito!", "success");
                } else {
                    swal(":(", "Fallo al agregar!", "error");
                }
            }
        });
    }
}
function eliminarRol(idrol) {
    idrol = parseInt(idrol, 10);
    if (idrol < 1) {
        swal("No tienes id de categoria!");
        return false;
    } else {
        swal({
            title: "ELIMINAR?",
            text: "Esta seguro que lo deseas eliminar   ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    data: { idrol: idrol },
                    url: "../procesos/roles/EliminarRol.php",
                    success: function(respuesta){
                        respuesta = respuesta.trim();
                        if (respuesta == 1) {
                            $('#tablaProgrmas').load("../vistas/programas/Tprograms.php");
                        swal("Eliminado con exito!", {
                        icon: "success",
                        });
                    }else{
                        
                        swal(":(", "Fallo al eliminar!","error");
                    }
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    }
}

function ActualisarRol(idrol) {
    // No necesitas validar aquí, la validación se realizará después de que el usuario ingrese el nombre en el modal
    //data-bs-toggle="modal" data-bs-target="#ActualizarRol"
    // Abres el modal
    //$('#ActualizarRol').modal('show');

    // Evento cuando el usuario hace clic en "Save changes"
    $('#btnActualizarRol').click(function() {
        var nuevoNombre = $('#NuevoNombreRol').val();
        console.log(nuevoNombre,"erros de nombre");
        if (nuevoNombre == "") {
            swal("Debes agregar un nuevo nombre para el rol");
            return false;
        } else {
            // Realizas la llamada AJAX para actualizar el rol
            $.ajax({
                type: "POST",
                data: { idrol: idrol, nuevoNombreRol: nuevoNombre },
                url: "../procesos/roles/ActualizarRol.php",
                success: function(respuesta) {
                    respuesta = respuesta.trim();
                    if (respuesta == 1) {
                        $('#tablaProgrmas').load("../vistas/programas/Tprograms.php");
                        swal(":D", "Rol actualizado con éxito!", "success");
                    } else {
                        alert(respuesta);
                        swal(":(", "Fallo al actualizar el rol!", "error");
                    }
                }
            });
        }
    });
}





