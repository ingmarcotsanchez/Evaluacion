<?php
    class EvaEstudiante extends Conectar{
        public function insert_evaEstudiante($pea_pregunta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO preguntas_EA (pea_id,pea_pregunta, estado) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pea_pregunta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_evaEstudiante($pea_id,$pea_pregunta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE preguntas_EA
                SET
                    pea_pregunta = ?
                WHERE
                    pea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pea_pregunta);
            $sql->bindValue(2, $pea_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_evaEstudiante($pea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EA SET estado=0 WHERE pea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($pea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EA SET estado=1 WHERE pea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($pea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EA SET estado=0 WHERE pea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaEstudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EA";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaEstudiante_id($pea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EA WHERE estado = 1 AND pea_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaEstudiantesAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EA WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaluadas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion_institucional";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>