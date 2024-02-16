<?php
    class cursoModels extends Conectar{

        public function insert_curso($cursoCategoriaId,$cursoNombre,$cursoDescripcion,$cursoFechaInicio,$cursoFechaFin,$cursoInstructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO curso (cursoId, cursoCategoriaId, cursoNombre, cursoDescripcion, cursoFechaInicio, cursoFechaFin, cursoInstructorId,cursoImagen, cursoFechaCreacion, cursoEstado) VALUES (NULL,?,?,?,?,?,?,'../../public/1.png', now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoCategoriaId);
            $sql->bindValue(2, $cursoNombre);
            $sql->bindValue(3, $cursoDescripcion);
            $sql->bindValue(4, $cursoFechaInicio);
            $sql->bindValue(5, $cursoFechaFin);
            $sql->bindValue(6, $cursoInstructorId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_curso($cursoId,$cursoCategoriaId,$cursoNombre,$cursoDescripcion,$cursoFechaInicio,$cursoFechaFin,$cursoInstructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE curso
                SET
                    cursoCategoriaId =?,
                    cursoNombre = ?,
                    cursoDescripcion = ?,
                    cursoFechaInicio = ?,
                    cursoFechaFin = ?,
                    cursoInstructorId = ?
                WHERE
                    cursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoCategoriaId);
            $sql->bindValue(2, $cursoNombre);
            $sql->bindValue(3, $cursoDescripcion);
            $sql->bindValue(4, $cursoFechaInicio);
            $sql->bindValue(5, $cursoFechaFin);
            $sql->bindValue(6, $cursoInstructorId);
            $sql->bindValue(7, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_curso($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE curso
                SET
                    cursoEstado = 0
                WHERE
                    cursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_curso(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                curso.cursoId,
                curso.cursoNombre,
                curso.cursoDescripcion,
                curso.cursoFechaInicio,
                curso.cursoFechaFin,
                curso.cursoCategoriaId,
                curso.cursoImagen,
                categoria.categoriaNombre,
                curso.cursoInstructorId,
                instructor.instructorNombre,
                instructor.instructorApellidoPaterno,
                instructor.instructorApellidoMaterno,
                instructor.instructorCorreo,
                instructor.instructorSexo,
                instructor.instructorTelefono
                FROM curso
                INNER JOIN categoria on curso.cursoCategoriaId = categoria.categoriaId
                INNER JOIN instructor on curso.cursoInstructorId = instructor.instructorId
                WHERE curso.cursoEstado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_curso_id($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM curso WHERE cursoEstado = 1 AND cursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_curso_usuario($detallecursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE detallecurso
                SET
                    detallecursoEstado = 0
                WHERE
                    detallecursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $detallecursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Insert Curso por Usuario */
        public function insert_curso_usuario($cursoId,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO detallecurso (detallecursoId,detallecursoCursoId,detallecursoUsuarioId,detallecursoFechaCreacion,detallecursoEstado) VALUES (NULL,?,?,now(),1);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->bindValue(2, $usu_id);
            $sql->execute();

            $sql1="select last_insert_id() as 'detallecursoId'";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetch(pdo::FETCH_ASSOC);
        }

        public function update_imagen_curso($cursoId,$cursoImagen){
            $conectar= parent::conexion();
            parent::set_names();

            require_once("cursoModels.php");
            $curx = new cursoModels();
            $cursoImagen = '';
            if ($_FILES["cursoImagen"]["name"]!=''){
                $cursoImagen = $curx->upload_file();
            }

            $sql="UPDATE curso
                SET
                    cursoImagen = ?
                WHERE
                    cursoId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoImagen);
            $sql->bindValue(2, $cursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function upload_file(){
            if(isset($_FILES["cursoImagen"])){
                $extension = explode('.', $_FILES['cursoImagen']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../public/' . $new_name;
                move_uploaded_file($_FILES['cursoImagen']['tmp_name'], $destination);
                return "../../public/".$new_name;
            }
        }
    }
?>