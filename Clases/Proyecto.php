<?php  
    require_once "Conexion.php";
    try {
        class proyecto extends Conectar{
            public function asignarProyecto($idUsuario,$IDPropuesta){
                $conexion = $this->conexion();
                $sqlInsert="INSERT INTO proyecto (IDPropuesta, IDusuariorol, aprobado)VALUES (?, ?, 0);";
                $smtasignarProyecto=$conexion->prepare($sqlInsert);
                $smtasignarProyecto->bind_param("ii", $IDPropuesta,$idUsuario);
                $smtasignarProyecto->execute();
                $smtasignarProyecto->close();
            }

            public function Asigarjuado($IDProyecto,$IdROlUser){
                $conexion = $this->conexion();
                $sqlInsertJurado="INSERT INTO jurado (IDProyecto, IDusuariorol) VALUES (?, ?)";
                $smtAsignarJurado=$conexion->prepare($sqlInsertJurado);
                $smtAsignarJurado->bind_param("ii", $IDProyecto,$IdROlUser);
                $smtAsignarJurado->execute();
                $smtAsignarJurado->close();
                }
            
            public function ObtenerDatosProyecto($IDProyecto){
                $conexion = $this->conexion();
                $sqlDatosProyecto="SELECT propuesta.Titulo,
                                CONCAT(usuarios.Nombre, ' ', usuarios.Apellido) AS Director,
                                propuesta.Resumen
                                FROM proyecto
                                INNER JOIN propuesta ON proyecto.IDPropuesta = propuesta.IDPropuesta
                                INNER JOIN usuariorol ON proyecto.IDusuariorol = usuariorol.IDUsuariorol
                                INNER JOIN usuarios ON usuariorol.IDusuario = usuarios.IDUser
                                WHERE proyecto.IDProyecto = ?";
                $smtDatosProyecto=$conexion->prepare($sqlDatosProyecto);
                $smtDatosProyecto->bind_param("i",$IDProyecto);
                $smtDatosProyecto->execute();
                $ResultadoDatos= $smtDatosProyecto->get_result();
                $datosProyectos=$ResultadoDatos->fetch_assoc();
                return $datosProyectos;
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }
?>