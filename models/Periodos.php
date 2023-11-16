<?php
    class Periodos extends Conectar{
        public function insert_periodo($per_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO periodo (per_id,per_nombre, estado) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $per_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_periodo($per_id,$per_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE periodo
                SET
                    per_nombre = ?
                WHERE
                    per_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $per_nombre);
            $sql->bindValue(2, $per_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_periodo($per_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE periodo SET estado=0 WHERE per_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function periodos(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM periodo WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function periodos_id($per_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM periodo WHERE estado = 1 AND per_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>