<?php
    class usuarioModels extends Conectar{
        /*TODO: Funcion para login de acceso del usuario */
        public function login() {
            $conectar = parent::conexion();
            parent::set_names();
        
            if (isset($_POST["enviar"])) {
                $correo = $_POST["usuarioCorreo"];
                $pass = $_POST["usuarioPassword"];
        
                $sql = "CALL login(?, ?)";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $pass);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($resultado['resultado'] == 2) {
                    // Correo o contraseña vacíos, redirigir al index con mensaje = 2
                    header("Location: " . conectar::ruta() . "index.php?m=2");
                    exit();
                } elseif ($resultado['usuarioId'] != null) {
                    // Usuario autenticado, establecer variables de sesión y redirigir a la página de inicio
                    $_SESSION["usuarioId"] = $resultado["usuarioId"];
                    $_SESSION["usuarioNombre"] = $resultado["usuarioNombre"];
                    $_SESSION["usuarioApellidoPaterno"] = $resultado["usuarioApellidoPaterno"];
                    $_SESSION["usuarioCorreo"] = $resultado["usuarioCorreo"];
                    $_SESSION["usuarioRolId"] = $resultado["usuarioRolId"];
                    header("Location: " . Conectar::ruta() . "view/UsuHome/");
                    exit();
                } else {
                    // Usuario o contraseña incorrectos, redirigir al index con mensaje = 1
                    header("Location: " . conectar::ruta() . "index.php?m=1");
                    exit();
                }
            }
        }
        

        /*TODO: Mostrar todos los cursos en los cuales esta inscrito un usuario */
        public function get_cursos_x_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_cursos_x_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar todos los cursos en los cuales esta inscrito un usuario */
        public function get_cursos_x_usuario_top10($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_cursos_x_usuario_top10(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public  function get_cursos_usuario_x_id($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_cursos_usuario_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar todos los datos de un curso por su id de detalle */
        public function get_curso_x_id_detalle($detallecursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_curso_x_id_detalle(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $detallecursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Cantidad de Cursos por Usuario */
        public function get_total_cursos_x_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_total_cursos_x_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar los datos del usuario segun el ID */
        public function get_usuario_x_id($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_usuario_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar los datos del usuario segun el DNI */
        public function get_usuario_x_dni($usuarioDni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_usuario_x_dni(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioDni);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Actualizar la informacion del perfil del usuario segun ID */
        public function update_usuario_perfil($usuarioId,$usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioPassword,$usuarioSexo,$usuarioTelefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL update_usuario_perfil(?, ?, ?, ?, ?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $usuarioId, PDO::PARAM_INT);
            $sql->bindParam(2, $usuarioNombre, PDO::PARAM_STR);
            $sql->bindParam(3, $usuarioApellidoPaterno, PDO::PARAM_STR);
            $sql->bindParam(4, $usuarioApellidoMaterno, PDO::PARAM_STR);
            $sql->bindParam(5, $usuarioPassword, PDO::PARAM_STR);
            $sql->bindParam(6, $usuarioSexo, PDO::PARAM_STR);
            $sql->bindParam(7, $usuarioTelefono, PDO::PARAM_STR);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Funcion para insertar usuario */
        public function insert_usuario($usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioCorreo,$usuarioPassword,$usuarioSexo,$usuarioTelefono,$usuarioRolId ,$usuarioDni ){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL insert_usuario(?,?,?,?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioNombre);
            $sql->bindValue(2, $usuarioApellidoPaterno);
            $sql->bindValue(3, $usuarioApellidoMaterno);
            $sql->bindValue(4, $usuarioCorreo);
            $sql->bindValue(5, $usuarioPassword);
            $sql->bindValue(6, $usuarioSexo);
            $sql->bindValue(7, $usuarioTelefono);
            $sql->bindValue(8, $usuarioRolId);
            $sql->bindValue(9, $usuarioDni); 
            $sql->execute();
            return $sql->fetchAll();
        }

        /*TODO: Funcion para actualizar usuario */
        public function update_usuario($usuarioId,$usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioCorreo,$usuarioPassword,$usuarioSexo,$usuarioTelefono,$usuarioRolId ,$usuarioDni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL update_usuario(?,?,?,?,?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->bindValue(2, $usuarioNombre);
            $sql->bindValue(3, $usuarioApellidoPaterno);
            $sql->bindValue(4, $usuarioApellidoMaterno);
            $sql->bindValue(5, $usuarioCorreo);
            $sql->bindValue(6, $usuarioPassword);
            $sql->bindValue(7, $usuarioSexo);
            $sql->bindValue(8, $usuarioTelefono);
            $sql->bindValue(9, $usuarioRolId);
            $sql->bindValue(10, $usuarioDni); 
            $sql->execute();
            return $sql->fetchAll();
        }

        /*TODO: Eliminar cambiar de estado a la categoria */
        public function delete_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL delete_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Listar todas las categorias */
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_usuario()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Listar todas las categorias */
        public function get_usuario_modal($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
           /*  $sql="SELECT * FROM usuario 
                WHERE usuarioEstado = 1
                AND usuarioId not in (select detallecursoUsuarioId from detallecurso where detallecursoCursoId=? AND detallecursoEstado=1)"; */

            $sql = "CALL get_usuario_modal(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId, PDO::PARAM_INT);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }