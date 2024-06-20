<?php
session_start();
require_once "../../../Clases/Propuestas.php";
require_once "../../../Clases/usuario.php";
$idUsuario=$_SESSION['idusuario'];

try {
    $IDPropuesta = $_POST['IDPropuesta'];
    $formData = $_POST['frmCalificarPropuesta'];
    parse_str($formData, $formArrayCalaificacion);

    $PlanteamientoProblema = $formArrayCalaificacion['PlanteamientoProblema'];
    $MarcoTeorico = $formArrayCalaificacion['MarcoTeorico'];
    $Objetivos = $formArrayCalaificacion['Objetivos'];
    $Metodologia = $formArrayCalaificacion['Metodologia'];
    $GradoPerteneciaAcademica = $formArrayCalaificacion['GradoPerteneciaAcademica'];
    $ImpactoPertenencia = $formArrayCalaificacion['ImpactoPertenencia'];
    $Cronograma = $formArrayCalaificacion['Cronograma'];

    $notaFinal = $formArrayCalaificacion['PlanteamientoProblema'] +
            $formArrayCalaificacion['MarcoTeorico'] +
            $formArrayCalaificacion['Objetivos'] +
            $formArrayCalaificacion['Metodologia'] +
            $formArrayCalaificacion['GradoPerteneciaAcademica'] +
            $formArrayCalaificacion['ImpactoPertenencia'] +
            $formArrayCalaificacion['Cronograma'];

    
    //header('Content-Type: text/plain'); 
    $idRolUsuario=new Usuario();
    $IdROlUser=$idRolUsuario->ObtenerIDusriorol($idUsuario);
    //print_r($_POST);
    $NuevaCalificacion=new Propuesta();
    $CalifcicacionPropuesta=$NuevaCalificacion->CalificarPropuesta($formArrayCalaificacion,$IDPropuesta,$IdROlUser,$notaFinal); 
    echo $CalifcicacionPropuesta;
    //NOta final que tendra la propuesta
    $NotaFinalPropuestas=new Propuesta();
    $CalificacionFinal=$NotaFinalPropuestas->CalificacionFinal($IDPropuesta);

} catch (Throwable $th) {
    echo $th;
}
?>  