<?php
    class cursoModels extends Conectar{

        public function insert_curso($cursoCategoriaId,$cursoNombre,$cursoDescripcion,$cursoFechaInicio,$cursoFechaFin,$cursoInstructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL insert_curso(?, ?, ?, ?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $cursoCategoriaId, PDO::PARAM_INT);
            $sql->bindParam(2, $cursoNombre, PDO::PARAM_STR);
            $sql->bindParam(3, $cursoDescripcion, PDO::PARAM_STR);
            $sql->bindParam(4, $cursoFechaInicio, PDO::PARAM_STR);
            $sql->bindParam(5, $cursoFechaFin, PDO::PARAM_STR);
            $sql->bindParam(6, $cursoInstructorId, PDO::PARAM_INT);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_curso($cursoId,$cursoCategoriaId,$cursoNombre,$cursoDescripcion,$cursoFechaInicio,$cursoFechaFin,$cursoInstructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL update_curso(?, ?, ?, ?, ?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $cursoId, PDO::PARAM_INT);
            $sql->bindParam(2, $cursoCategoriaId, PDO::PARAM_INT);
            $sql->bindParam(3, $cursoNombre, PDO::PARAM_STR);
            $sql->bindParam(4, $cursoDescripcion, PDO::PARAM_STR);
            $sql->bindParam(5, $cursoFechaInicio, PDO::PARAM_STR);
            $sql->bindParam(6, $cursoFechaFin, PDO::PARAM_STR);
            $sql->bindParam(7, $cursoInstructorId, PDO::PARAM_INT);
            $sql->execute();

            return $resultado=$sql->fetchAll();
        }

        public function delete_curso($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL delete_curso(?)";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $cursoId, PDO::PARAM_INT);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_curso(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_curso()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_curso_id($cursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_curso_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->execute();    
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_curso_usuario($detallecursoId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL delete_curso_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $detallecursoId);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*TODO: Insert Curso por Usuario */
        public function insert_curso_usuario($cursoId, $usu_id) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $sql = "CALL insert_curso_usuario(?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $cursoId, PDO::PARAM_INT);
            $sql->bindParam(2, $usu_id, PDO::PARAM_INT);
            $sql->execute();
        
            return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        
        
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

            $sql = "CALL update_imagen_curso(?, ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cursoId);
            $sql->bindValue(2, $cursoImagen);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
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