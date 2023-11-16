<?php
    class InsEstudiante extends Conectar{
        public function insert_insEstudiante($pei_pregunta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO preguntas_EI (pei_id,pei_pregunta, estado) VALUES (NULL,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pei_pregunta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_insEstudiante($pei_id,$pei_pregunta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE preguntas_EI
                SET
                    pei_pregunta = ?
                WHERE
                    pei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pei_pregunta);
            $sql->bindValue(2, $pei_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_insEstudiante($pei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EI SET estado=0 WHERE pei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($pei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EI SET estado=1 WHERE pei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($pei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE preguntas_EI SET estado=0 WHERE pei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insEstudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EI";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insEstudiantesAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EI WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insEstudiante_id($pei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM preguntas_EI WHERE estado = 1 AND pei_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$pei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>