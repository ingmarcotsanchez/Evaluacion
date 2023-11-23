<?php
    class Autoevaluacion extends Conectar{
        public function insert_autoevaluacion($usu_id,$auto_pregunta,$auto_respuesta){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO autoevaluacion_institucional (auto_id, usu_id, mat_id, auto_pregunta, auto_respuesta, auto_estado, fec_crea, estado) 
                                VALUES (NULL,?,1,?,?,0,now(),1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $auto_pregunta);
            $sql->bindValue(3, $auto_respuesta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function listar($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            autoevaluacion_institucional.auto_id,
            usuarios.usu_id,
            usuarios.usu_nombre,
            usuarios.usu_apellidos,
            materias.mat_id,
            materias.mat_codigo,
            materias.mat_nombre,
            autoevaluacion_institucional.auto_pregunta,
            autoevaluacion_institucional.auto_respuesta,
            autoevaluacion_institucional.auto_estado,
            autoevaluacion_institucional.estado
            FROM autoevaluacion_institucional
            INNER JOIN materias on autoevaluacion_institucional.mat_id = materias.mat_id
            INNER JOIN usuarios on autoevaluacion_institucional.usu_id = usuarios.usu_id
            WHERE 
            autoevaluacion_institucional.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function completadas($usu_id,$mat_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion_institucional
            WHERE usu_id = ? AND mat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $mat_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaluaciones(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion_institucional";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function realizadas($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM autoevaluacion_institucional WHERE auto_estado=0 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

    }