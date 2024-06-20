<?php
require_once "Conexion.php";
try {
    class roles extends Conectar{
        
        public function agregarrol($Rol){
            $conexion = $this->conexion(); 
            $sql="INSERT INTO rol (NombreRol) VALUES (?)";
            $query = $conexion->prepare($sql);
            $query->bind_param('s', $Rol);
            $query->execute();
            $query->store_result();
            $row = $query->fetch();
            $count = $row ? $row['count'] : 0;
            $query->close();
            return 1;   
        }
        public function eliminarrol($idrol){
            $conexion = $this->conexion(); 
            $sql = "DELETE FROM rol WHERE IDRol = ?"; 
            $query = $conexion->prepare($sql);
            $query->bind_param('i', $idrol);
            $respuesta = null; // define $respuesta here
            if ($query->execute()) {
                $respuesta = 1; // set $respuesta to 1 if the query was successful
            } else {
                $respuesta = 0; // set $respuesta to 0 if the query failed
            }
            $query->close();
            return $respuesta;
        }
        public function actualizarrol($idrol, $nuevoNombreRol) {
            $conexion = $this->conexion(); 
            $sql = "UPDATE rol SET NombreRol = ? WHERE IDRol = ?"; 
            $query = $conexion->prepare($sql);
            $query->bind_param('si', $nuevoNombreRol, $idrol);
            $respuesta = $query->execute() ? 1 : 0; // Ternary operator to set $respuesta based on query success
            $query->close();
            return $respuesta;
        }
        public function obtenerRoles() {
            $conexion = $this->conexion(); // Establece la conexión
    
            $query = "SELECT IDRol, NombreRol FROM rol"; // Consulta SQL para obtener los nombres de los roles
    
            $resultado = $conexion->query($query);
    
            $roles = array(); // Array para almacenar los nombres de los roles
    
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $roles[$fila['IDRol']] = $fila['NombreRol'];
                }
            }
    
            return $roles; // Devuelve el array de roles
        }
    }
} catch (\Throwable $th) {
    echo $th;
}
?>