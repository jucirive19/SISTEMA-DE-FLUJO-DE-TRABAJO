<?php  
    require_once "Conexion.php";
    try {
        class Usuario extends Conectar{

            public function agregarusuario($datosUsuario){
    
                $conexion = $this->conexion(); 
                
                $conexion = $this->conexion(); 
                $sql="INSERT INTO usuarios (Nombre,Apellido,Ndocumento,Ntelefono,Correo,Pasword,FechaNacimiento) VALUES (?, ?, ?, ?, ?, ?,?)";
                $query = $conexion->prepare($sql);
                $query->bind_param('ssiisss',$datosUsuario['Nombre'],      
                                                $datosUsuario['Apellido'],
                                                $datosUsuario['Ndocumento'],
                                                $datosUsuario['Ntelefono'],
                                                $datosUsuario['Correo'],   
                                                $datosUsuario['password'],
                                                $datosUsuario['fechaNacimiento']);
                $respuesta=$query->execute();
                if($respuesta){
                    // Obtener el ID del usuario recién insertado
                    $id_usuario = $conexion->insert_id; 
                    if ($id_usuario) {
                        $InserUsuariorol="INSERT INTO usuariorol(IDrol,IDusuario,IDprogrma)VALUES (1,?,?)";
                        $queryUsuarioRol=$conexion->prepare($InserUsuariorol);
                        $queryUsuarioRol->bind_param('ii',$id_usuario,$datosUsuario['NombrePrograma']);
                        $exitoUsuarioRol=$queryUsuarioRol->execute();
                        if ($exitoUsuarioRol) {
                            return 1; // Éxito en la inserción del usuario y el rol
                        } else {
                            return false; // Fallo en la inserción del rol
                        }
                    } else {
                        return false; // Fallo en la obtención del ID del usuario
                    }
                    
                } else {
                    return false; // Fallo en la inserción del usuario
                }
            }
                
                // Método para verificar si un correo electrónico ya existe en la base de datos
                public function verificarCorreo($correo) {
                    $conexion = $this->conexion();
                    $sql = "SELECT COUNT(*) as count FROM usuarios WHERE Correo = ?";
                    $query = $conexion->prepare($sql);
                    $query->bind_param('s', $correo);
                    $query->execute();
                    $result = $query->get_result();
                    $row = $result->fetch_assoc();
                    $count = $row['count'];
                    $query->close();
                    return $count > 0; // Devuelve true si el correo existe, false si no existe
                }
                // Método para iniciar sesión y obtener los permisos del usuario
                public function verificarUsuario($correo, $password) {
                    $conexion = $this->conexion();
                    $passwordHasheada = sha1($password);
                    $sql = "SELECT usuarios.IDUser, usuarios.Ndocumento, usuarioRol.IDrol
                    FROM usuarios
                    INNER JOIN usuarioRol ON usuarios.IDUser = usuarioRol.IDusuario
                    WHERE usuarios.Correo = ? AND usuarios.Pasword = ?";
                    $query = $conexion->prepare($sql);
                    $query->bind_param('ss', $correo, $passwordHasheada);
                    $query->execute();
                    $resultado = $query->get_result();
                
                    if ($resultado->num_rows > 0) {
                        $usuario = $resultado->fetch_assoc();
                        $idUsuario = $usuario['IDUser'];
                        $UsuarNdocuemnto=$usuario['Ndocumento'];
                        $UsuarioRol=$usuario['IDrol'];
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['usuario'] = $correo; 
                        $_SESSION['idusuario'] = $idUsuario;
                        $_SESSION['NDocuemnto']= $UsuarNdocuemnto;
                        $_SESSION['rol']=$UsuarioRol;
                
                        // Obtener el ID del rol del usuario
                        $consultaRol = "SELECT IDrol FROM usuariorol WHERE IDusuario = ?";
                        $stmtRol = $conexion->prepare($consultaRol);
                        $stmtRol->bind_param('i', $idUsuario);
                        $stmtRol->execute();
                        $resultRol = $stmtRol->get_result();
                        $rol = $resultRol->fetch_assoc();
                        $idRol = $rol['IDrol'];
                        print $idRol;
                        return $idRol;
                    } else {
                        return false;
                    }
                }

                public function NuvoDocente($datosUsuario){
                    $conexion = $this->conexion(); 
                    $sql="INSERT INTO usuarios (Nombre,Apellido,Ndocumento,Ntelefono,Correo,Pasword) VALUES (?, ?, ?, ?, ?, ?)";
                    $query = $conexion->prepare($sql);
                    $query->bind_param('ssiiss',$datosUsuario['Nombre'],      
                                                    $datosUsuario['Apellido'],
                                                    $datosUsuario['Ndocumento'],
                                                    $datosUsuario['Ntelefono'],
                                                    $datosUsuario['Correo'],   
                                                    $datosUsuario['password']);
                    $respuesta=$query->execute();
                    if($respuesta){
                        // Obtener el ID del usuario recién insertado
                        $id_usuario = $conexion->insert_id; 
                        if ($id_usuario) {
                            $InserUsuariorol="INSERT INTO usuariorol(IDrol,IDusuario,IDprogrma)VALUES (?,?,?)";
                            $queryUsuarioRol=$conexion->prepare($InserUsuariorol);
                            $queryUsuarioRol->bind_param('iii',$datosUsuario['NombreRol'],
                                                                $id_usuario,
                                                                $datosUsuario['NombrePrograma']);
                            $exitoUsuarioRol=$queryUsuarioRol->execute();
                            if ($exitoUsuarioRol) {
                                return 1; // Éxito en la inserción del usuario y el rol
                            } else {
                                return false; // Fallo en la inserción del rol
                            }
                        } else {
                            return false; // Fallo en la obtención del ID del usuario
                        }
                        
                    } else {
                        return false; // Fallo en la inserción del usuario
                    }
                }
                public function ObtenerIDusriorol($idUsuario){
                    $conexion = $this->conexion();
                    $consultaIDUserRol = "SELECT IDUsuariorol FROM usuariorol WHERE IDusuario = ?";
                    $stmtRol = $conexion->prepare($consultaIDUserRol);
                    $stmtRol->bind_param('i', $idUsuario);
                    $stmtRol->execute();
                    $resultRol = $stmtRol->get_result();
                    $usuariorol = $resultRol->fetch_assoc();
                    $idRol = $usuariorol['IDUsuariorol'];
                    //print $idRol;
                    return $idRol;

                }
                
                public function obtenerUsuarios() {
                    $conexion = $this->conexion();
                    
                    $queryNombres = "SELECT usuarios.IDUser, CONCAT(usuarios.Nombre, ' ', usuarios.Apellido) AS NombreApellido 
                                    FROM usuarios 
                                    INNER JOIN usuariorol ON usuarios.IDUser = usuariorol.IDusuario
                                    WHERE usuariorol.IDRol!= 1";
                    
                    $resultadoNombres = $conexion->query($queryNombres);
                
                    if ($resultadoNombres === false) {
                        // Error en la consulta SQL
                        die("Error en la consulta: ". $conexion->error);
                    }
                    
                    $usuariosName = array();
                    
                    if ($resultadoNombres->num_rows > 0) {
                        // Procesar los resultados
                        while ($fila = $resultadoNombres->fetch_assoc()) {
                            $usuariosName[$fila['IDUser']] = $fila['NombreApellido'];
                        }
                    } else {
                        // No se encontraron resultados
                        echo "No se encontraron usuarios.";
                    }
                    
                    return $usuariosName; 
                }
        }
    } catch (\Throwable $th) {
        echo $th;
    }
?>

