<?php
    class RInsProfesor extends Conectar{
        public function insert_rinsProfesor($ppi_id,$rpi_respuesta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO respuestas_PI (rpi_id, ppi_id,rpi_respuesta, estado) VALUES (NULL,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ppi_id);
            $sql->bindValue(2, $rpi_respuesta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_rinsProfesor($rpi_id,$ppi_id,$rpi_respuesta){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE respuestas_PI
                SET
                    ppi_id = ?,
                    rpi_pregunta = ?
                WHERE
                    rpi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ppi_id);
            $sql->bindValue(2, $rpi_respuesta);
            $sql->bindValue(3, $rpi_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_rinsProfesor($rpi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_PI SET estado=0 WHERE rpi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rpi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_estadoActivo($rpi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_PI SET estado=1 WHERE rpi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rpi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($rpi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE respuestas_PI SET estado=0 WHERE rpi_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rpi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsProfesores(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_PI.rpi_id,
                    preguntas_PI.ppi_id,
                    preguntas_PI.ppi_pregunta,
                    respuestas_PI.rpi_respuesta,
                    respuestas_PI.estado
                    FROM respuestas_PI
                    INNER JOIN preguntas_PI on respuestas_PI.ppi_id = preguntas_PI.ppi_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsProfesor_id($rpi_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM respuestas_PI WHERE estado = 1 AND rpi_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$rpi_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rinsProfesoresAct(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                    respuestas_PI.rpi_id,
                    preguntas_PI.ppi_id,
                    preguntas_PI.ppi_pregunta,
                    respuestas_PI.rpi_respuesta,
                    respuestas_PI.estado
                    FROM respuestas_PI
                    INNER JOIN preguntas_PI on respuestas_PI.ppi_id = preguntas_PI.ppi_id
                    WHERE respuestas_PI.estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>