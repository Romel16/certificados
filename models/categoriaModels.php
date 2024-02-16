<?php
    class categoriaModels extends Conectar{
        /*TODO: Funcion para insertar categoria */
        public function insert_categoria($categoriaNombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO categoria (categoriaId, categoriaNombre,categoriaFechaCreacion, categoriaEstado) VALUES (NULL,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaNombre);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Funcion para actualizar categoria */
        public function update_categoria($categoriaId,$categoriaNombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE categoria
                SET
                    categoriaNombre = ?
                WHERE
                    categoriaId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaNombre);
            $sql->bindValue(2, $categoriaId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Eliminar cambiar de estado a la categoria */
        public function delete_categoria($categoriaId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE categoria
                SET
                    categoriaEstado = 0
                WHERE
                    categoriaId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Listar todas las categorias */
        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM categoria WHERE categoriaEstado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*TODO: Filtrar segun ID de categoria */
        public function get_categoria_id($categoriaId){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM categoria WHERE categoriaId = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoriaId);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
