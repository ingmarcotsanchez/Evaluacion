<?php
    class Rol extends Conectar{
        public function insert_rol($rol_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO rol (rol_id,rol_nombre, est) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $rol_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_rol($rol_id,$rol_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE rol
                SET
                    rol_nombre = ?
                WHERE
                    rol_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $rol_nombre);
            $sql->bindValue(2, $rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_rol($rol_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE rol SET est=0 WHERE rol_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rol_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function roles(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM rol WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function roles_id($rol_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM rol WHERE est = 1 AND rol_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rol_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>