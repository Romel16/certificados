<?php
    class categoriaModels extends Conectar{
        /*TODO: Funcion para insertar categoria */
        public function insert_categoria($categoriaNombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL insert_categoria(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaNombre);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*TODO: Funcion para actualizar categoria */
        public function update_categoria($categoriaId,$categoriaNombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL update_categoria(?, ?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaId);
            $sql->bindValue(2, $categoriaNombre);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*TODO: Eliminar cambiar de estado a la categoria */
        public function delete_categoria($categoriaId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL delete_categoria(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaId);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*TODO: Listar todas las categorias */
        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_categoria()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        /*TODO: Filtrar segun ID de categoria */
        public function get_categoria_id($categoriaId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql = "CALL get_categoria_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaId);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
