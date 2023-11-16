<?php
    class Institucional extends Conectar{
        
        public function insert_institucional($usu_id,$eva_pregunta,$eva_respuesta){
        
            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO evaluacion_Ins (eva_id, usu_id, eva_pregunta, eva_respuesta, eva_estado, fec_crea, estado) 
                                VALUES (NULL,?,?,?,0,now(),1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $eva_pregunta);
            $sql->bindValue(3, $eva_respuesta);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function listar($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
            evaluacion_Ins.eva_id,
            usuarios.usu_id,
            usuarios.usu_nombre,
            usuarios.usu_apellidos,
            evaluacion_Ins.eva_pregunta,
            evaluacion_Ins.eva_respuesta,
            evaluacion_Ins.eva_estado,
            evaluacion_Ins.estado
            FROM evaluacion_Ins
            INNER JOIN usuarios on evaluacion_Ins.usu_id = usuarios.usu_id
            WHERE 
            evaluacion_Ins.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function evaluaciones(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM evaluacion_Ins";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function realizadas($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM evaluacion_Ins WHERE estado=1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_realizadasIns(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(distinct usu_id) as total FROM evaluacion_Ins WHERE estado=1";
            //$sql="SELECT DISTINCT usu_id FROM evaluacion_Ins";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function total_realizadasAuto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(distinct usu_id) as total FROM autoevaluacion_institucional WHERE estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }