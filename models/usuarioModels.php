<?php
    class usuarioModels extends Conectar{
        /*TODO: Funcion para login de acceso del usuario */
        public function login(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usuarioCorreo"];
                $pass = $_POST["usuarioPassword"];
                if(empty($correo) and empty($pass)){
                    /*TODO: En caso esten vacios correo y contraseña, devolver al index con mensaje = 2 */
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $sql = "SELECT * FROM usuario WHERE usuarioCorreo=? and usuarioPassword=? and usuarioEstado=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array($resultado) and count($resultado)>0){
                        $_SESSION["usuarioId"]=$resultado["usuarioId"];
                        $_SESSION["usuarioNombre"]=$resultado["usuarioNombre"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["usuarioCorreo"]=$resultado["usuarioCorreo"];
                        $_SESSION["usuarioRolId"]=$resultado["usuarioRolId"];
                        /*TODO: Si todo esta correcto indexar en home */
                        header("Location:".Conectar::ruta()."view/UsuHome/");
                        exit();
                    }else{
                        /*TODO: En caso no coincidan el usuario o la contraseña */
                        header("Location:".conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

        /*TODO: Mostrar todos los cursos en los cuales esta inscrito un usuario */
        public function get_cursos_x_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                detallecurso.detallecursoId,
                curso.cursoId,
                curso.cursoNombre,
                curso.cursoDescripcion,
                curso.cursoFechaInicio,
                curso.cursoFechaFin,
                usuario.usuarioId,
                usuario.usuarioNombre,
                usuario.usuarioApellidoPaterno,
                usuario.usuarioApellidoMaterno,
                /* usuario.usuarioDni, */
                instructor.instructorId,
                instructor.instructorNombre,
                instructor.instructorApellidoPaterno,
                instructor.instructorApellidoMaterno
                FROM detallecurso INNER JOIN 
                curso ON detallecurso.detallecursoCursoId = curso.cursoId INNER JOIN
                usuario ON detallecurso.detallecursoUsuarioId = usuario.usuarioId INNER JOIN
                instructor ON curso.cursoInstructorId = instructor.instructorId
                WHERE 
                detallecurso.detallecursoUsuarioId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar todos los cursos en los cuales esta inscrito un usuario */
        public function get_cursos_x_usuario_top10($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                detallecurso.detallecursoId,
                curso.cursoId,
                curso.cursoNombre,
                curso.cursoDescripcion,
                curso.cursoFechaInicio,
                curso.cursoFechaFin,
                usuario.usuarioId,
                usuario.usuarioNombre,
                usuario.usuarioApellidoPaterno,
                usuario.usuarioApellidoMaterno,
                /*usuario.usuarioDni, */
                instructor.instructorId,
                instructor.instructorNombre,
                instructor.instructorApellidoPaterno,
                instructor.instructorApellidoMaterno
                FROM detallecurso INNER JOIN 
                curso ON detallecurso.detallecursoCursoId = curso.cursoId INNER JOIN
                usuario ON detallecurso.detallecursoUsuarioId = usuario.usuarioId INNER JOIN
                instructor ON curso.cursoInstructorId = instructor.instructorId
                WHERE 
                detallecurso.detallecursoUsuarioId = ?
                AND detallecurso.detallecursoEstado = 1
                LIMIT 10";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public  function get_cursos_usuario_x_id($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                detallecurso.detallecursoId,
                curso.cursoId,
                curso.cursoNombre,
                curso.cursoDescripcion,
                curso.cursoFechaInicio,
                curso.cursoFechaFin,
                usuario.usuarioId,
                usuario.usuarioNombre,
                usuario.usuarioApellidoPaterno,
                usuario.usuarioApellidoMaterno,
                /* usuario.usuarioDni, */
                instructor.instructorId,
                instructor.instructorNombre,
                instructor.instructorApellidoPaterno,
                instructor.instructorApellidoMaterno
                FROM detallecurso INNER JOIN 
                curso ON detallecurso.detallecursoCursoId = curso.cursoId INNER JOIN
                usuario ON detallecurso.detallecursoUsuarioId = usuario.usuarioId INNER JOIN
                instructor ON curso.cursoInstructorId = instructor.instructorId
                WHERE 
                curso.cursoId = ?
                AND detallecurso.detallecursoEstado = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar todos los datos de un curso por su id de detalle */
        public function get_curso_x_id_detalle($detallecursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                detallecurso.detallecursoId,
                curso.cursoId,
                curso.cursoNombre,
                curso.cursoDescripcion,
                curso.cursoFechaInicio,
                curso.cursoFechaFin,
                usuario.usuarioId,
                usuario.usuarioNombre,
                usuario.usuarioApellidoPaterno,
                usuario.usuarioApellidoMaterno,
                curso.cursoImagen,
                instructor.instructorId,
                instructor.instructorNombre,
                instructor.instructorApellidoPaterno,
                instructor.instructorApellidoMaterno
                FROM detallecurso INNER JOIN 
                curso ON detallecurso.detallecursoCursoId = curso.cursoId INNER JOIN
                usuario ON detallecurso.detallecursoUsuarioId = usuario.usuarioId INNER JOIN
                instructor ON curso.cursoInstructorId = instructor.instructorId
                WHERE 
                detallecurso.detallecursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $detallecursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Cantidad de Cursos por Usuario */
        public function get_total_cursos_x_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM detallecurso WHERE detallecursoUsuarioId=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar los datos del usuario segun el ID */
        public function get_usuario_x_id($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE usuarioEstado=1 AND usuarioId=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Mostrar los datos del usuario segun el DNI */
        public function get_usuario_x_dni($usuarioDni){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE usuarioEstado=1 AND usuarioDni=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioDni);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Actualizar la informacion del perfil del usuario segun ID */
        public function update_usuario_perfil($usuarioId,$usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioPassword,$usuarioSexo,$usuarioTelefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario 
                SET
                    usuarioNombre = ?,
                    usuarioApellidoPaterno = ?,
                    usuarioApellidoMaterno = ?,
                    usuarioPassword = ?,
                    usuarioSexo = ?,
                    usuarioTelefono = ?
                WHERE
                    usuarioId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioNombre);
            $sql->bindValue(2, $usuarioApellidoPaterno);
            $sql->bindValue(3, $usuarioApellidoMaterno);
            $sql->bindValue(4, $usuarioPassword);
            $sql->bindValue(5, $usuarioSexo);
            $sql->bindValue(6, $usuarioTelefono);
            $sql->bindValue(7, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Funcion para insertar usuario */
        public function insert_usuario($usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioCorreo,$usuarioPassword,$usuarioSexo,$usuarioTelefono,$usuarioRolId/* ,$usuarioDni */){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO usuario (usuarioId,usuarioNombre,usuarioApellidoPaterno,usuarioApellidoMaterno,usuarioCorreo,usuarioPassword,usuarioSexo,usuarioTelefono,usuarioRolId/* usuarioDni */,usuarioFechaCreacion, usuarioEstado) VALUES (NULL,?,?,?,?,?,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioNombre);
            $sql->bindValue(2, $usuarioApellidoPaterno);
            $sql->bindValue(3, $usuarioApellidoMaterno);
            $sql->bindValue(4, $usuarioCorreo);
            $sql->bindValue(5, $usuarioPassword);
            $sql->bindValue(6, $usuarioSexo);
            $sql->bindValue(7, $usuarioTelefono);
            $sql->bindValue(8, $usuarioRolId);
           /*  $sql->bindValue(9, $usuarioDni); */
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Funcion para actualizar usuario */
        public function update_usuario($usuarioId,$usuarioNombre,$usuarioApellidoPaterno,$usuarioApellidoMaterno,$usuarioCorreo,$usuarioPassword,$usuarioSexo,$usuarioTelefono,$usuarioRolId/* ,$usuarioDni */){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usuarioNombre = ?,
                    usuarioApellidoPaterno = ?,
                    usuarioApellidoMaterno = ?,
                    usuarioCorreo = ?,
                    usuarioPassword = ?,
                    usuarioSexo = ?,
                    usuarioTelefono = ?,
                    usuarioRolId = ?/* ,
                    usuarioDni = ? */
                WHERE
                    usuarioId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioNombre);
            $sql->bindValue(2, $usuarioApellidoPaterno);
            $sql->bindValue(3, $usuarioApellidoMaterno);
            $sql->bindValue(4, $usuarioCorreo);
            $sql->bindValue(5, $usuarioPassword);
            $sql->bindValue(6, $usuarioSexo);
            $sql->bindValue(7, $usuarioTelefono);
            $sql->bindValue(8, $usuarioRolId);
            /* $sql->bindValue(9, $usuarioDni); */
            $sql->bindValue(9, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Eliminar cambiar de estado a la categoria */
        public function delete_usuario($usuarioId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE usuario
                SET
                    usuarioEstado = 0
                WHERE
                    usuarioId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usuarioId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Listar todas las categorias */
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario WHERE usuarioEstado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Listar todas las categorias */
        public function get_usuario_modal($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM usuario 
                WHERE usuarioEstado = 1
                AND usuarioId not in (select detallecursoUsuarioId from detallecurso where detallecursoCursoId=? AND detallecursoEstado=1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }