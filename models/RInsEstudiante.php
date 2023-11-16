<?php
    class RInsEstudiante extends Conectar{
        public function insert_rinsEstudiante($pei_id,$rei_respuesta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO respuestas_EI (rei_id, pei_id,rei_respuesta, estado) VALUES (NULL,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pei_id);
            $sql->bindValue(2, $rei_respuesta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_rinsEstudiante($rei_id,$pei_id,$rei_respuesta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE respuestas_EI
                SET
                    pei_id = ?,
                    rei_pregunta = ?
                WHERE
                    rei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pei_id);
            $sql->bindValue(2, $rei_respuesta);
            $sql->bindValue(3, $rei_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_rinsEstudiante($rei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EI SET estado=0 WHERE rei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($rei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EI SET estado=1 WHERE rei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($rei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EI SET estado=0 WHERE rei_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsEstudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_EI.rei_id,
                    preguntas_EI.pei_id,
                    preguntas_EI.pei_pregunta,
                    respuestas_EI.rei_respuesta,
                    respuestas_EI.estado
                    FROM respuestas_EI
                    INNER JOIN preguntas_EI on respuestas_EI.pei_id = preguntas_EI.pei_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsEstudiantesAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_EI.rei_id,
                    preguntas_EI.pei_id,
                    preguntas_EI.pei_pregunta,
                    respuestas_EI.rei_respuesta,
                    respuestas_EI.estado
                    FROM respuestas_EI
                    INNER JOIN preguntas_EI on respuestas_EI.pei_id = preguntas_EI.pei_id
                    WHERE respuestas_EI.estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsEstudiante_id($rei_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM respuestas_EI WHERE estado = 1 AND rei_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rei_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>