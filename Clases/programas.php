<?php
require_once "Conexion.php";
try {
    class programas extends Conectar{
        public function obtenerProgramas(){
            $conexion = $this->conexion(); 
            $query = "SELECT IDprogrma, Nombre FROM progrmas"; // Consulta SQL para obtener los nombres de los programas
    
            $resultado = $conexion->query($query);
    
            $Programas = array(); // Array para almacenar los nombres de los Programas
    
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $Programas[$fila['IDprogrma']] = $fila['Nombre'];
                }
            }
    
            return $Programas; // Devuelve el array de roles
        }
    }
} catch (\Throwable $th) {
    
}
?>