<?php
    class REvaEstudiante extends Conectar{
        public function insert_revaEstudiante($pea_id,$rea_respuesta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO respuestas_EA (rea_id, pea_id,rea_respuesta, estado) VALUES (NULL,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pea_id);
            $sql->bindValue(2, $rea_respuesta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_revaEstudiante($rea_id,$pea_id,$rea_respuesta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE respuestas_EA
                SET
                    pea_id = ?,
                    rea_pregunta = ?
                WHERE
                    rea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $pea_id);
            $sql->bindValue(2, $rea_respuesta);
            $sql->bindValue(3, $rea_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_revaEstudiante($rea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EA SET estado=0 WHERE rea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($rea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EA SET estado=1 WHERE rea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($rea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_EA SET estado=0 WHERE rea_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function revaEstudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_EA.rea_id,
                    preguntas_EA.pea_id,
                    preguntas_EA.pea_pregunta,
                    respuestas_EA.rea_respuesta,
                    respuestas_EA.estado
                    FROM respuestas_EA
                    INNER JOIN preguntas_EA on respuestas_EA.pea_id = preguntas_EA.pea_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function revaEstudiantesAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_EA.rea_id,
                    preguntas_EA.pea_id,
                    preguntas_EA.pea_pregunta,
                    respuestas_EA.rea_respuesta,
                    respuestas_EA.estado
                    FROM respuestas_EA
                    INNER JOIN preguntas_EA on respuestas_EA.pea_id = preguntas_EA.pea_id
                    WHERE respuestas_EA.estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function revaEstudiante_id($rea_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM respuestas_EA WHERE estado = 1 AND rea_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rea_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>