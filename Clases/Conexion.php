<?php 
    class Conectar{
        public function conexion(){
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'proyecto';

            $conexion = mysqli_connect($servername, $username, $password, $dbname);
            $conexion->set_charset('utf8mb4');

            // Verificar si hay errores de conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            return $conexion;
        }
    }
?>


