<?php
require_once "Conexion.php";
try {
    class editar extends Conectar{
        public function ObtenerDatosUsuario($IDUsuario) {
            $conexion = $this->conexion(); 
            $sql = "SELECT 
                        usuarios.Nombre,
                        usuarios.Apellido,
                        usuarios.Ndocumento,
                        usuarios.Ntelefono,
                        usuarios.Correo,
                        usuarios.FechaNacimiento,
                        usuarios.Pasword
                    FROM 
                        usuarios 
                    WHERE 
                        usuarios.IDUser = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $datosUsuario = $resultado->fetch_assoc();
            return $datosUsuario;
        }

        public function ObtenerRolUsuario($IDUsuario) {
            $conexion = $this->conexion(); 
            $sql = "SELECT 
                        rol.NombreRol
                    FROM 
                        usuariorol 
                    INNER JOIN 
                        rol ON usuariorol.IDrol = rol.IDRol
                    WHERE 
                        usuariorol.IDusuario = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $rolUsuario = $resultado->fetch_assoc();
            return $rolUsuario['NombreRol'];
        }
        
        public function ActualizarDocente($datosActualizados){
            $conexion = $this->conexion(); 
            //print_r($datosActualizados);
             // Actualizar los datos de la tabla usuarios
            $sql = "UPDATE usuarios
                    SET Nombre = ?,Apellido = ?,Ndocumento = ?,Ntelefono = ?,Correo = ?,Pasword = ?
                    WHERE IDUser = ?";

             // Prepare the query
            $query = $conexion->prepare($sql);
            
            $query->bind_param('ssiissi', $datosActualizados['NuevoNombreDocente'],
                                            $datosActualizados['NuevoApellidoDocente'], 
                                            $datosActualizados['NuevoNdocumentoDocente'], 
                                            $datosActualizados['NuevotelefonoDocente'], 
                                            $datosActualizados['NuevoCorreoDocente'], 
                                            $datosActualizados['ContraseñaDocente'], 
                                            $datosActualizados['IDUsuario']);
            $result = $query->execute();
            if (!$result) {
                throw new Exception("Error al actualizar los datos de la tabla usuarios: " . $conexion->error);
            }
            $query->close();

            // Actualizar los datos de la tabla usuariorol
            $progrma=$datosActualizados['ProgramaSelect'];
            $rol=$datosActualizados['RolSelect'];
            $sqlUsuariorol = "UPDATE usuariorol SET IDrol = ?, IDprogrma = ? WHERE IDusuario = ?";
            $respuestaUsuariorol = $conexion->prepare($sqlUsuariorol);
            $respuestaUsuariorol->bind_param('iii', $rol,$progrma, $datosActualizados['IDUsuario']);
            $result = $respuestaUsuariorol->execute();
            if (!$result) {
                throw new Exception("Error al actualizar los datos de la tabla usuariorol: " . $conexion->error);
            }
            $respuestaUsuariorol->close();


            return  true;
        }
        
    }
} catch (\Throwable $th) {
    echo $th;
}
?>
