<?php
    class instructorModels extends Conectar{

        public function insert_instructor($instructorNombre,$instructorApellidoPaterno,$instructorApellidoMaterno,$instructorCorreo,$instructorSexo,$instructorTelefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO instructor (instructorId, instructorNombre, instructorApellidoPaterno, instructorApellidoMaterno, instructorCorreo, instructorSexo, instructorTelefono, instructorFechaCreacion, instructorEstado) VALUES (NULL,?,?,?,?,?,?, now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorNombre);
            $sql->bindValue(2, $instructorApellidoPaterno);
            $sql->bindValue(3, $instructorApellidoMaterno);
            $sql->bindValue(4, $instructorCorreo);
            $sql->bindValue(5, $instructorSexo);
            $sql->bindValue(6, $instructorTelefono);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_instructor($instructorId,$instructorNombre,$instructorApellidoPaterno,$instructorApellidoMaterno,$instructorCorreo,$instructorSexo,$instructorTelefono){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE instructor
                SET
                    instructorNombre = ?,
                    instructorApellidoPaterno = ?,
                    instructorApellidoMaterno = ?,
                    instructorCorreo = ?,
                    instructorSexo = ?,
                    instructorTelefono = ?
                WHERE
                    instructorId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorNombre);
            $sql->bindValue(2, $instructorApellidoPaterno);
            $sql->bindValue(3, $instructorApellidoMaterno);
            $sql->bindValue(4, $instructorCorreo);
            $sql->bindValue(5, $instructorSexo);
            $sql->bindValue(6, $instructorTelefono);
            $sql->bindValue(7, $instructorId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_instructor($instructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE instructor
                SET
                    instructorEstado = 0
                WHERE
                    instructorId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_instructor(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM instructor WHERE instructorEstado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_instructor_id($instructorId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM instructor WHERE instructorEstado = 1 AND instructorId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $instructorId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>