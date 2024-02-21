<?php
    class instructorModels extends Conectar{

        public function insert_instructor($instructorNombre, $instructorApellidoPaterno, $instructorApellidoMaterno, $instructorCorreo, $instructorSexo, $instructorTelefono) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $sql = "CALL insert_instructor(?, ?, ?, ?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $instructorNombre);
            $sql->bindValue(2, $instructorApellidoPaterno);
            $sql->bindValue(3, $instructorApellidoMaterno);
            $sql->bindValue(4, $instructorCorreo);
            $sql->bindValue(5, $instructorSexo);
            $sql->bindValue(6, $instructorTelefono);
            $sql->execute();
        
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        

        public function update_instructor($instructorId,$instructorNombre,$instructorApellidoPaterno,$instructorApellidoMaterno,$instructorCorreo,$instructorSexo,$instructorTelefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL update_instructor(?, ?, ?, ?, ?, ?, ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorId);
            $sql->bindValue(2, $instructorNombre);
            $sql->bindValue(3, $instructorApellidoPaterno);
            $sql->bindValue(4, $instructorApellidoMaterno);
            $sql->bindValue(5, $instructorCorreo);
            $sql->bindValue(6, $instructorSexo);
            $sql->bindValue(7, $instructorTelefono);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_instructor($instructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL delete_instructor(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorId);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_instructor(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_instructor()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_instructor_id($instructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_instructor_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorId);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
