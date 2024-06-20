<?php
    require_once "Conexion.php";
    try {
        class Propuesta extends Conectar {
            public function NuevaPropuesta($DatosPropuesta, $nombre_archivo, $ruta_temporal) {
                $conexion = $this->conexion(); 
                
                // Consulta para obtener el IDUsuariorol
                $consulta_usuario = "SELECT usuariorol.IDUsuariorol 
                                    FROM usuarios 
                                    INNER JOIN usuariorol ON usuarios.IDUser = usuariorol.IDusuario 
                                    WHERE usuarios.Correo = ?";
                $stmt_consulta_usuario = $conexion->prepare($consulta_usuario);
                $stmt_consulta_usuario->bind_param('s', $DatosPropuesta['idusuario']);
                $stmt_consulta_usuario->execute();
                $stmt_consulta_usuario->bind_result($id_usuariorol);
                $stmt_consulta_usuario->fetch();
                $stmt_consulta_usuario->close();
    
                // Consulta para insertar la propuesta
                $sql_insert_propuesta = "INSERT INTO propuesta (Titulo, Resumen, PalabrasClave, Fecha, IDUserRol) 
                                        VALUES (?, ?, ?, ?, ?)";
                $stmt_insert_propuesta = $conexion->prepare($sql_insert_propuesta);
                $stmt_insert_propuesta->bind_param('ssssi', $DatosPropuesta['Titulo'], 
                                                                $DatosPropuesta['Resumen'], 
                                                                $DatosPropuesta['PalabrasClave'], 
                                                                $DatosPropuesta['Fecha'], 
                                                                $id_usuariorol);
                $respuesta_propuesta = $stmt_insert_propuesta->execute() ? 1 : 0;
                $stmt_insert_propuesta->close();
    
                // Consulta #documeto Usuario
                $consultaNdocumento="SELECT usuarios.Ndocumento FROM usuarios INNER JOIN usuariorol
                ON usuarios.IDUser = usuariorol.IDusuario WHERE usuariorol.IDUsuariorol = ?";
                $respuestaNdocumento=$conexion->prepare($consultaNdocumento);
                $respuestaNdocumento->bind_param('i',$id_usuariorol);
                $respuestaNdocumento->execute();
                $respuestaNdocumento->bind_result($NumeroDOcumento);
                $respuestaNdocumento->fetch();
                $respuestaNdocumento->close();
    
                if ($respuesta_propuesta) {
                    // Consulta para obtener el ID de la propuesta recién insertada
                    $sql_id_propuesta = "SELECT IDPropuesta 
                                        FROM propuesta 
                                        WHERE Titulo = ?";
                    $stmt_id_propuesta = $conexion->prepare($sql_id_propuesta);
                    $stmt_id_propuesta->bind_param('s', $DatosPropuesta['Titulo']);
                    $stmt_id_propuesta->execute();
                    $stmt_id_propuesta->bind_result($id_propuesta);
                    $stmt_id_propuesta->fetch();
                    $stmt_id_propuesta->close();
    
                    // Ruta donde se guardarán los documentos
                    $Fecha = date('Y-m-d');
                    $ruta_carpeta = "../../../Propuestas/". $NumeroDOcumento."/".$Fecha;
                    $archivo_destino = $ruta_carpeta . '/' . $nombre_archivo;
    
                    // Verificar si la carpeta existe, si no, crearla
                    if (!file_exists($ruta_carpeta)) {
                        mkdir($ruta_carpeta, 0755, true);
                    }
    
                    if (move_uploaded_file($ruta_temporal, $archivo_destino)) {
                        // Consulta para insertar el documento
                        $sql_insert_documento = "INSERT INTO documento (IDPropuesta, Documento) 
                                                VALUES (?, ?)";
                        $stmt_insert_documento = $conexion->prepare($sql_insert_documento);
                        $stmt_insert_documento->bind_param('is', $id_propuesta, $archivo_destino);
                        $stmt_insert_documento->execute();
                        $stmt_insert_documento->close();
                        return 1; // Éxito
                    } else {
                        return 0; // Error al mover el archivo
                    }
                } else {
                    return 0; // Error al insertar la propuesta
                }
            }
            public function ObtenerDatosPropuesta($IDPropuesta){
                $conexion = $this->conexion(); 
                $sql="SELECT propuesta.Titulo, propuesta.Resumen,propuesta.PalabrasClave
                FROM propuesta WHERE propuesta.IDPropuesta=?";
                $RespusestaPropuesta=$conexion->prepare($sql);
                $RespusestaPropuesta->bind_param("i", $IDPropuesta);
                $RespusestaPropuesta->execute();
                $resultado=$RespusestaPropuesta->get_result();
                $DatosPropuesta=$resultado->fetch_assoc();
                return $DatosPropuesta;
            }

            public function ObetnerCalificaciones($IDPropuesta, $IdROlUser){
                $conexion = $this->conexion();
                $sqlCalificacion="SELECT NPlantemientoProblema, NEstadodelArte, NObjetivos, NMetodologia, NGradoPerteneciaAcademica, NImpactoPertenecia, NCronogrmas, Notafinal
                                FROM evaluacionpropuesta
                                WHERE IDPropuesta = ? AND IDusuariorol = ?";
                $smtNotaPropuesta=$conexion->prepare($sqlCalificacion);
                $smtNotaPropuesta->bind_param("ii",$IDPropuesta, $IdROlUser);
                $smtNotaPropuesta->execute();
                $resultadonotas=$smtNotaPropuesta->get_result();
                $DatosCalificacion=$resultadonotas->fetch_assoc();
                
                return $DatosCalificacion;
            }

            public function CalificarPropuesta($formArrayCalaificacion,$IDPropuesta,$IdROlUser,$notaFinal){
                $conexion = $this->conexion(); 
                $sqlCalificacionPropuestas="INSERT INTO evaluacionpropuesta(IDPropuesta,IDusuariorol,NPlantemientoProblema,NEstadodelArte,NObjetivos,NMetodologia,NGradoPerteneciaAcademica,NImpactoPertenecia,NCronogrmas,Notafinal)
                                            VALUES (?,?,?,?,?,?,?,?,?,?)";
                $smtCalificacion=$conexion->prepare($sqlCalificacionPropuestas);
                $smtCalificacion->bind_param("iiiiiiiiii", $IDPropuesta,
                                                            $IdROlUser,
                                                            $formArrayCalaificacion['PlanteamientoProblema'],
                                                            $formArrayCalaificacion['MarcoTeorico'],
                                                            $formArrayCalaificacion['Objetivos'],
                                                            $formArrayCalaificacion['Metodologia'],
                                                            $formArrayCalaificacion['GradoPerteneciaAcademica'],
                                                            $formArrayCalaificacion['ImpactoPertenencia'],
                                                            $formArrayCalaificacion['Cronograma'],
                                                            $notaFinal);
                $success = $smtCalificacion->execute();
                $smtCalificacion->close();
                $respuesta=1;
                return $respuesta;
                //return $smtCalificacion->affected_rows > 0;
            }
            public function VerPropuesta($IDPropuesta){
                $conexion = $this->conexion();
                $sqlRutapropuesta="SELECT documento.Documento FROM documento WHERE IDPropuesta=?";
                $stm_ruta_propuesta=$conexion->prepare($sqlRutapropuesta);
                $stm_ruta_propuesta->bind_param("i", $IDPropuesta);
                $stm_ruta_propuesta->execute();
                $resultadoRuta=$stm_ruta_propuesta->get_result();
                $datosRuta=$resultadoRuta->fetch_assoc();
                return $datosRuta['Documento']; // Return the first element of the 'Documento' column
                
            }

            public function validarEvaluacion($IDPropuesta, $idUsuario) {
                $conexion = $this->conexion();
                $sqlConsultaCalificacion = "SELECT COUNT(*) AS count
                                            FROM evaluacionpropuesta
                                            WHERE IDPropuesta = ? AND IDusuariorol = ?";
                $stmConsultaExisteCalificacion = $conexion->prepare($sqlConsultaCalificacion);
                $stmConsultaExisteCalificacion->bind_param("ii", $IDPropuesta, $idUsuario);
                $stmConsultaExisteCalificacion->execute();
                $resultado = $stmConsultaExisteCalificacion->get_result();
                $datoExisteCalificacion = $resultado->fetch_assoc();
                return $datoExisteCalificacion['count'];
            }
            public function validarConIDUserRol($idUsuario){
                $conexion = $this->conexion();
                $sqlConsultaPropuestasUsuario = "SELECT COUNT(*) AS count FROM propuesta WHERE IDUserRol  = ?";
                $stmConsultaPropuestaPorIDuser = $conexion->prepare($sqlConsultaPropuestasUsuario);
                $stmConsultaPropuestaPorIDuser->bind_param("i", $idUsuario);
                $stmConsultaPropuestaPorIDuser->execute();
                $resultado = $stmConsultaPropuestaPorIDuser->get_result();
                $datoExistepropuesta = $resultado->fetch_assoc();
                return $datoExistepropuesta['count'];
            }
            public function validarConNuDocumento($NuDocumento){
                $conexion = $this->conexion();
                $sqlConsultaPoropuestaCC="SELECT COUNT(*) AS cantidad FROM propuesta INNER JOIN usuariorol 
                                                    ON propuesta.IDUserRol = usuariorol.IDUsuariorol
                                                    INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser 
                                                    WHERE propuesta.IntegrantesDos = ?";
                $smtConsultaPorpuestacc=$conexion->prepare($sqlConsultaPoropuestaCC);
                $smtConsultaPorpuestacc->bind_param("i", $NuDocumento);
                $smtConsultaPorpuestacc->execute();
                $resultadoCC=$smtConsultaPorpuestacc->get_result();
                $existePrpuestacc=$resultadoCC->fetch_assoc();
                return $existePrpuestacc['cantidad'];
            }
            public function CalificacionFinal($IDPropuesta){
                $conexion = $this->conexion();
                $sqlNotafinalPromedio="SELECT 
                                        SUM(Notafinal) / COUNT(*) AS promedio_notas
                                    FROM 
                                        evaluacionpropuesta
                                    WHERE 
                                        IDPropuesta = ?";
                $smtPromedioCalificacion=$conexion->prepare($sqlNotafinalPromedio);
                $smtPromedioCalificacion->bind_param("i", $IDPropuesta);
                $smtPromedioCalificacion->execute();
                $resultadoPromedioCalificacion=$smtPromedioCalificacion->get_result();
                $PromedioCalificacion=$resultadoPromedioCalificacion->fetch_assoc();
            
                // Insertar el promedio de calificaciones en la tabla 'Notafinal'
                $sqlInsertarNotafinal = "INSERT INTO notafinal (IDPropuesta, notafinal) VALUES (?, ?)";
                $smtInsertarNotafinal = $conexion->prepare($sqlInsertarNotafinal);
                $smtInsertarNotafinal->bind_param("ii", $IDPropuesta, $PromedioCalificacion['promedio_notas']);
                $smtInsertarNotafinal->execute();
            
                // Verificar si la inserción fue exitosa
                if ($smtInsertarNotafinal->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            /*
            public function ObetnerCalificaciones($IdROlUser,$IDPropuesta){
                $conexion = $this->conexion();
                $sqlCalificacion="SELECT NPlantemientoProblema, NEstadodelArte, NObjetivos, NMetodologia, NGradoPerteneciaAcademica, NImpactoPertenecia, NCronogrmas, Notafinal
                                FROM evaluacionpropuesta
                                WHERE IDPropuesta = ? AND IDusuariorol = ?";
                $smtNotaPropuesta=$conexion->prepare($sqlCalificacion);
                $smtNotaPropuesta->bind_param("ii",$IDPropuesta, $IdROlUser);
                $smtNotaPropuesta->execute();
                $resultadonota=$smtNotaPropuesta->get_result();
                $DatosCalificacion=array();
                while($row = $resultadonota->fetch_assoc()){
                    $DatosCalificacion[] = $row;
                }
                return $DatosCalificacion;
            }*/
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
?>