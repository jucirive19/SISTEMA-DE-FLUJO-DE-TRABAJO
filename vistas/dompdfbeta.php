<?php
// Ruta al archivo PDF
$rutaArchivo = '../Propuestas/1118573960/2024-04-05/Juan_Camilo Rivera Perilla_Resume (2).pdf';

// Establecer encabezados para indicar que es un archivo PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="documento.pdf"');

// Mostrar el contenido del archivo PDF
readfile($rutaArchivo);
?>