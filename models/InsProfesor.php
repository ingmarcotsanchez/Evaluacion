<?php
    class InsProfesor extends Conectar{
        public function insert_insProfesor($ppi_pregunta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO preguntas_PI (ppi_id,ppi_pregunta, estado) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ppi_pregunta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_insProfesor($ppi_id,$ppi_pregunta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE preguntas_PI
                SET
                    ppi_pregunta = ?
                WHERE
                    ppi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ppi_pregunta);
            $sql->bindValue(2, $ppi_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_insProfesor($ppi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_PI SET estado=0 WHERE ppi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ppi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($ppi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_PI SET estado=1 WHERE ppi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ppi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($ppi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_PI SET estado=0 WHERE ppi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ppi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insProfesores(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_PI";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insProfesoresAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_PI WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insProfesor_id($ppi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_PI WHERE estado = 1 AND ppi_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ppi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>