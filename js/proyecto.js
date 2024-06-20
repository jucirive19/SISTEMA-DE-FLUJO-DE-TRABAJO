
function ObtenerDatosProyecto(IDProyecto) {
    proyectoActual = IDProyecto;
    console.log(proyectoActual);
}
function AsignarJurado() {
    var proyectoAcalificar = proyectoActual // Obtiene el ID del proyecto actual
    var jurado1 = $('#jurado1').val(); // Obtiene el valor del primer select
    var jurado2 = $('#jurado2').val(); // Obtiene el valor del segundo select

    // Envía los datos al servidor mediante AJAX
    $.ajax({
        method: "POST",
        data: { 'proyectoAcalificar': proyectoAcalificar, 'jurado1': jurado1, 'jurado2': jurado2 },
        url: "../procesos/proyecto/AsignarJurado/AsignarJurado.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
            console.log('exito', respuesta);
            swal(":)", "Jurado asignado con éxito", "success")
            $('#frmAsignarJurado')[0].reset(); // Limpia los campos del formulario
            $('#ModalAsignarJurado').modal('hide'); // Cierra el modal
            } else {
            console.log("error: ", respuesta);
            swal(":(", "Ya has enviado una propuesta previamente.", "warning");
            }
        }
        });
    }
    var proyectoActual;
    function cargarDatosProyecto(IDProyecto) {
        proyectoActual = IDProyecto;
        $.ajax({
            method: "POST",
            data: { IDProyecto: IDProyecto },
            url: "../procesos/proyecto/DatosProyecto/ObtenerDatosProyecto.php",
            success: function(respuesta) {
                console.log(respuesta);
                
                try {
                    var datosProyectos=JSON.parse(respuesta);
                    
                    $('#tituloVista').val(datosProyectos.Titulo);
                    $('#DirectorVista').val(datosProyectos.Director);
                    $('#resumenVista').val(datosProyectos.Resumen);

                    $('#visualizarProyecto').modal('show');
                } catch (error) {
                    console.error('Error al analizar la respuesta JSON:', error);
                } 
            },error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
            
            });
        }