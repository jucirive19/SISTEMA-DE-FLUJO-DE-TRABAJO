
    function NuevaPropuesta() {
        $.ajax({
            method: "POST",
            url: "../procesos/propuestas/nuevapropuesta/vlidarpropuesta.php",
            success: function(respuesta) {
                respuesta = respuesta.trim();
                if (respuesta === "existe_usuario") {
                    //console.log('existe por idusuario',respuesta);
                    console.log(respuesta);
                    swal(":(", "Ya has enviado una propuesta previamente.", "warning");
                } else if (respuesta === "existe_documento") {
                    console.log('existe por cc',respuesta);

                    swal(":(", "Ya existe una propuesta con un segundo integrante asociado.", "warning");
                } else {
                    console.log('no existe continua',respuesta);
                    
                    // Si no existe ninguna propuesta asociada, proceder con el envío de la nueva propuesta
                    var formData = new FormData($('#frmPorpuesta')[0]);
                    $.ajax({
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        cache: false,
                        url: "../procesos/propuestas/nuevapropuesta/nuevaPropuesta.php",
                        success: function(respuesta) {
                            respuesta = respuesta.trim();
                            if (respuesta > 0) {
                                swal(":D", "Agregado con éxito!", "success");
                            } else {
                                alert(respuesta);
                                swal(":(", "Fallo al agregar!", "error");
                            }
                        }
                    }); 
                }
            }
        });
    }


var idPropuestaActual; // Declara una variable global para almacenar el IDPropuesta

function ObtenerDatosPropuesta(IDPropuesta) {
    idPropuestaActual = IDPropuesta;
    $.ajax({
        type: "POST",
        data: { IDPropuestas: IDPropuesta },
        url: "../procesos/propuestas/datosPropuesta/ObtenerDatosPropuesta.php",
        success: function(respuesta) {
            try {
                var datosPropuesta = JSON.parse(respuesta);
                // Actualizar los campos del modal con los datos de la propuesta
                $('#tituloVista').val(datosPropuesta.Titulo);
                $('#resumenVista').val(datosPropuesta.Resumen);
                $('#palabras_claveVista').val(datosPropuesta.PalabrasClave);
                // Mostrar el modal
                $('#VisaulisarPropuesta').modal('show');
                window.IDPropuesta = IDPropuesta;
            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
        }
    });
}

function ObtenerDatosCalificacion() {
    var IDPropuestaCalificacion = idPropuestaActual;
    $.ajax({
        method: "POST",
        data: { 'IDPropuesta': IDPropuestaCalificacion },
        url: "../procesos/propuestas/CalificarPropuesta/ValidarCalificacionDatos.php",
        success: function (respuesta) {
            //console.log("tiene calificacion:", respuesta);
            
            // Verifica si la respuesta es una cadena vacía
            if (respuesta == "0") {
                //console.log("Respuesta del servidor:", respuesta);
                // Aquí puedes mostrar un mensaje de error o no hacer nada
            } else {
                //console.log("aprobo", respuesta);
                var calificacion = JSON.parse(respuesta);
                if (calificacion === null) {
                    console.error("La respuesta JSON es nula.");
                    return;
                }
                $('#PlanteamientoProblema').val(calificacion.NPlantemientoProblema);
                $('#MarcoTeorico').val(calificacion.NEstadodelArte);
                $('#Objetivos').val(calificacion.NObjetivos);
                $('#Metodologia').val(calificacion.NMetodologia);
                $('#GradoPerteneciaAcademica').val(calificacion.NGradoPerteneciaAcademica);
                $('#ImpactoPertenencia').val(calificacion.NImpactoPertenecia);
                $('#Cronograma').val(calificacion.NCronogrmas);
                $('#notaFinalVista').val(calificacion.Notafinal);
                $('#CalificarPropuesta').modal('show'); 
            }
            
        }
    });
}


function VisualisarDocumentoPropuestas() {
    // Utiliza la variable global idPropuestaActual para obtener el IDPropuesta
    var IDPropuesta = idPropuestaActual;
    $.ajax({
        method: "GET", // Cambia el método a GET
        url: "../procesos/propuestas/visualiarPorpuesta/visulisarPropuesta.php",
        data: { 'IDPropuesta': IDPropuesta }, // Envía el IDPropuesta por GET
        success: function(data) {
            window.open("../procesos/propuestas/visualiarPorpuesta/visulisarPropuesta.php?IDPropuesta=" + IDPropuesta, "_blank");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
}

function NotaPropuesta() {
    var inputs = $('#frmCalificarPropuesta input');
    var isEmpty = false;
    inputs.each(function() {
        if (!$(this).val() && $(this).attr('id') !== 'notaFinalVista') {
            isEmpty = true;
            return false; // Salir del bucle si se encuentra un campo vacío
        }
    });

    if (isEmpty) {
        swal("Oops...", "Por favor, llene todos los campos del formulario.", "warning");
        return;
    }
    swal({
        title: "Subir Nota Propuesta",
        text: "Estas de acuerdo con las notas que vas a subir recuerda que estas no se pueden modificar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            // Verificar si ya existe una calificación para esta propuesta por este usuario
            $.ajax({
                method: "POST",
                data: {
                    'IDPropuesta': window.IDPropuesta,
                },
                url: "../procesos/propuestas/CalificarPropuesta/ValidarCalificacion.php",
                success: function (respuesta) {
                    respuesta = respuesta.trim();
                    if (respuesta == "existe") {
                        swal("Ya existe una calificación para esta propuesta realizada por este usuario.", {
                            icon: "warning",
                        });
                    } else {
                        // Si no existe una calificación, proceder con la calificación
                        $.ajax({
                            method: "POST",
                            data: {
                                'IDPropuesta': window.IDPropuesta,
                                'frmCalificarPropuesta': $('#frmCalificarPropuesta').serialize()
                            },
                            url: "../procesos/propuestas/CalificarPropuesta/CalificarPropuesta.php",
                            success: function (respuesta) {
                                respuesta = respuesta.trim();
                                if (respuesta == 1) {
                                    console.log('exito',respuesta);
                                    $('#tablaProgrmas').load("../vistas/programas/Tprograms.php");
                                    swal("Subido con éxito!", {
                                        icon: "success",
                                    });
                                    $('#frmCalificarPropuesta')[0].reset(); // Restablecer el formulario después de enviar la solicitud
                                } else {
                                    console.log("error: ",respuesta);
                                    swal("Subido con éxito!", {
                                        icon: "success",
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
    });
}
function AsignarDirector(){
    var IDPropuestaDirector = idPropuestaActual; //obtengo el id de la propuesta actual
    $.ajax({
        method: "POST",
        data: { 'IDPropuesta': IDPropuestaDirector,'usuariosSelect': $('#usuariosSelect').val()},
        url: "../procesos/propuestas/asignardirector/asignardirector.php",
        success: function (respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                console.log('exito',respuesta);
                swal(":)", "asignado con exito", "success")
                $('#frmDirector')[0].reset();
                $('#ModalDirector').modal('hide');
            
            } else {
                console.log("error: ",respuesta);
                swal(":(", "Ya has enviado una propuesta previamente.", "warning");
                
            }
        }
    });
}


