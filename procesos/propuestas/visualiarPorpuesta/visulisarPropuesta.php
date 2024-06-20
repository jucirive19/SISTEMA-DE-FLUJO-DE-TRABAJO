<?php
session_start();
require_once "../../../Clases/Propuestas.php";

try {
    if(isset($_GET['IDPropuesta'])){
        $IDPropuesta = $_GET['IDPropuesta'];
        echo "IDPropuesta recibido por GET: " . $IDPropuesta; // Imprime el IDPropuesta recibido por GET
        $VisulisarDocumento = new Propuesta();
        $DocumentoVisulisar = $VisulisarDocumento->VerPropuesta($IDPropuesta);
        //print($DocumentoVisulisar);

        if (file_exists($DocumentoVisulisar)) {
            // Establecer las cabeceras para indicar que se está enviando un archivo PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="archivo.pdf"');
            // Leer y enviar el contenido del archivo PDF al navegador
            readfile($DocumentoVisulisar);
        }
    } else {
        echo "IDPropuesta no especificado."; 
    }
} catch (\Throwable $th) {
    // Manejar cualquier error que ocurra
    echo "Se produjo un error al intentar abrir el documento PDF: " . $th->getMessage();
}
?>



