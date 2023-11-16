<?php
    class Carreras extends Conectar{
        public function insert_carrera($car_snies,$car_nombre,$car_tipo,$car_sede){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO carreras (car_id, car_snies, car_nombre, car_tipo, car_sede, estado) 
                                VALUES (NULL,?,?,?,?,'1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $car_snies);
            $sql->bindValue(2, $car_nombre);
            $sql->bindValue(3, $car_tipo);
            $sql->bindValue(4, $car_sede);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_carrera($car_id,$car_snies,$car_nombre,$car_tipo,$car_sede){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE carreras
                SET
                    car_snies = ?,
                    car_nombre = ?,
                    car_tipo = ?,
                    car_sede = ?
                WHERE
                    car_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $car_snies);
            $sql->bindValue(2, $car_nombre);
            $sql->bindValue(3, $car_tipo);
            $sql->bindValue(4, $car_sede);
            $sql->bindValue(5, $car_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_carrera($car_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE carreras SET estado=0 WHERE car_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$car_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function carreras(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM carreras";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }


        public function carreras_id($car_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM carreras WHERE estado = 1 AND car_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$car_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_carreras(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM carreras WHERE estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estadoActivo($car_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE carreras SET estado=1 WHERE car_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$car_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($car_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE carreras SET estado=0 WHERE car_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$car_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>