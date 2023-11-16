<?php
    class Asignatura extends Conectar{
        public function insert_asignatura($car_id,$mat_codigo,$mat_nombre){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO materias (mat_id, car_id, mat_codigo, mat_nombre, estado) 
                                VALUES (NULL,?,?,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $car_id);
            $sql->bindValue(2, $mat_codigo);
            $sql->bindValue(3, $mat_nombre);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_asignatura($mat_id,$car_id,$mat_codigo,$mat_nombre){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE materias
                SET
                    car_id = ?,
                    mat_codigo = ?,
                    mat_nombre = ?
                WHERE
                    mat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $car_id);
            $sql->bindValue(2, $mat_codigo);
            $sql->bindValue(3, $mat_nombre);
            $sql->bindValue(4, $mat_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_asignatura($mat_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE materias SET estado=0 WHERE mat_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mat_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignaturas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM materias WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function asignaturas2(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                carreras.car_id,
                carreras.car_nombre,
                materias.mat_id,
                materias.mat_codigo,
                materias.mat_nombre,
                materias.estado
                FROM materias
                INNER JOIN carreras on materias.car_id = carreras.car_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function asignaturas_mantenimiento($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM materias WHERE materias.estado = 1
                AND mat_id not in (select mat_id from asignaturaXestudiante where usu_id=?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function asignaturas_id($mat_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM materias WHERE estado = 1 AND mat_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$mat_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_asignaturas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM materias WHERE estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>