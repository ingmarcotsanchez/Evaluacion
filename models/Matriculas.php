<?php
    class Matriculas extends Conectar{
        public function insert_matricula($mat_id, $usu_id_est, $grupo, $usu_id_pro){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO matriculas (matr_id, mat_id, usu_id_est, grupo, usu_id_pro, estado) 
                                VALUES (NULL,?,?,?,?,1);";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mat_id);
            $sql->bindValue(2, $usu_id_est);
            $sql->bindValue(3, $grupo);
            $sql->bindValue(4, $usu_id_pro);
            $sql->execute();

            return $resultado = $sql->fetchAll();
        }

        public function update_matricula($matr_id,$mat_id,$usu_id_est,$grupo,$usu_id_pro){

            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE matriculas
                SET
                    mat_id = ?,
                    usu_id_est = ?,
                    grupo = ?,
                    usu_id_pro = ?
                WHERE
                    matr_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $mat_id);
            $sql->bindValue(2, $usu_id_est);
            $sql->bindValue(3, $grupo);
            $sql->bindValue(4, $usu_id_pro);
            $sql->bindValue(5, $matr_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_matricula($matr_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE matriculas SET estado=0 WHERE matr_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$matr_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function matriculas(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM matriculas WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function matricula_X_estudiante($usu_id_est){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM matriculas WHERE estado = 1 AND usu_id_est=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id_est);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function matriculacion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            matriculas.matr_id,
            materias.mat_id,
            materias.mat_codigo,
            materias.mat_nombre,
            usuarios.usu_id,
            usuarios.usu_nombre,
            usuarios.usu_apellidos,
            matriculas.grupo,
            usuarios.usu_id as usuarios_profesores,
            matriculas.estado
            FROM matriculas
            INNER JOIN materias on matriculas.mat_id = materias.mat_id
            INNER JOIN usuarios on matriculas.usu_id_est = usuarios.usu_id
            INNER JOIN usuarios as usuarios_profesores on matriculas.usu_id_pro = usuarios_profesores.usu_id
            WHERE 
            usuarios.rol_id = 2 OR usuarios.rol_id=3";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function matriculadas(){//$usu_id_est
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            matriculas.matr_id,
            materias.mat_id,
            materias.mat_codigo,
            materias.mat_nombre,
            usuarios.usu_id,
            usuarios.usu_nombre,
            usuarios.usu_apellidos,
            matriculas.grupo,
            rol.rol_id,
            rol.rol_nombre,
            matriculas.estado
            FROM matriculas
            INNER JOIN materias on matriculas.mat_id = materias.mat_id
            INNER JOIN usuarios on matriculas.usu_id_pro = usuarios.usu_id
            INNER JOIN rol on matriculas.usu_id_pro = rol.rol_id
            WHERE 
            usuarios.rol_id = 3";// AND matriculas.usu_id_est = ?";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1,$usu_id_est);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function matriculas_id($matr_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM matriculas WHERE estado = 1 AND matr_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$matr_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        

        public function update_estadoActivo($matr_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE matriculas SET estado=1 WHERE matr_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$matr_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($matr_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE matriculas SET estado=0 WHERE matr_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$matr_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

    }
?>