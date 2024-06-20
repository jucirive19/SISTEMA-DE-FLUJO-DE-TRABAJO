<?php
/*
// Ruta al archivo PDF
$rutaArchivo = '../../../Propuestas/1118573960/2024-04-05/Juan_Camilo Rivera Perilla_Resume (2).pdf';
//$rutaArchivo2 = "../../../Propuestas/7891/2024-04-05/14776477401.pdf";

// Establecer encabezados para indicar que es un archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"');

// Mostrar el contenido del archivo PDF
readfile($rutaArchivo);*/
$ruta_pdf = '../../../Propuestas/1118573960/2024-04-05/Juan_Camilo Rivera Perilla_Resume (2).pdf';

// Verificar si el archivo existe
if (file_exists($ruta_pdf)) {
    // Establecer las cabeceras para indicar que se está enviando un archivo PDF
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="archivo.pdf"'); // Cambia el nombre del archivo si lo deseas

    // Leer y enviar el contenido del archivo PDF al navegador
    readfile($ruta_pdf);
} else {
    // Si el archivo no existe, mostrar un mensaje de error
    echo 'El archivo PDF no existe.';
}
?>
