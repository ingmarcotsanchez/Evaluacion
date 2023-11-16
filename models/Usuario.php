<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $usu_usuario = $_POST["usuario"];
                $usu_clave = $_POST["passwd"];
                if(empty($usu_usuario) and empty($usu_clave)){
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                }else{
                    //$sql = "SELECT * FROM usuarios WHERE usu_usuario=? and usu_clave=? and estado=1";
                    $sql = "SELECT
                    usuarios.usu_id,
                    usuarios.usu_usuario,
                    usuarios.usu_clave,
                    usuarios.usu_nombre,
                    usuarios.usu_apellidos,
                    usuarios.usu_email,
                    usuarios.car_id,
                    usuarios.usu_sede,
                    usuarios.estado,
                    carreras.car_id,
                    carreras.car_snies,
                    carreras.car_nombre,
                    rol.rol_id,
                    rol.rol_nombre

                  FROM usuarios
                  INNER JOIN rol on usuarios.rol_id = rol.rol_id
                  INNER JOIN carreras on usuarios.car_id = carreras.car_id
                WHERE usuarios.usu_usuario=? and usuarios.usu_clave=? and usuarios.estado=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1,$usu_usuario);
                    $stmt->bindValue(2,$usu_clave);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_usuario"]=$resultado["usu_usuario"];
                        $_SESSION["usu_nombre"]=$resultado["usu_nombre"];
                        $_SESSION["usu_apellidos"]=$resultado["usu_apellidos"];
                        $_SESSION["usu_email"]=$resultado["usu_email"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        $_SESSION["rol_nombre"]=$resultado["rol_nombre"];
                        if($resultado["usu_sede"] == "G"){
                            $_SESSION["usu_sede"]="Girardot";
                        }else{
                            $_SESSION["usu_sede"]="Bogotá";
                        }
                        
                        $_SESSION["car_id"]=$resultado["car_nombre"];
                        $_SESSION["snies"]=$resultado["car_snies"];
                        header("Location:".Conectar::ruta()."views/inicio.php");
                        exit();
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }   
        
        public function insert_usuario($usu_usuario,$usu_clave,$usu_nombre,$usu_apellidos,$usu_email,$car_id,$usu_pensum,$rol_id,$usu_direccion,$usu_tel,$per_id,$usu_sede){

            $conectar = parent::Conexion();
            parent::set_names();
            $sql="INSERT INTO usuarios (usu_id, usu_usuario, usu_clave, usu_nombre, usu_apellidos, usu_email, car_id, usu_pensum, rol_id, usu_direccion, usu_tel, per_id, usu_sede, estado) 
                                VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,'1');";
     
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_usuario);
            $sql->bindValue(2, $usu_clave);
            $sql->bindValue(3, $usu_nombre);
            $sql->bindValue(4, $usu_apellidos);
            $sql->bindValue(5, $usu_email);
            $sql->bindValue(6, $car_id);
            $sql->bindValue(7, $usu_pensum);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $usu_direccion);
            $sql->bindValue(10, $usu_tel);
            $sql->bindValue(11, $per_id);
            $sql->bindValue(12, $usu_sede);
            $sql->execute();
       
            return $resultado = $sql->fetchAll();
        }

        function obtenerRoles() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT rol_id, rol_nombre FROM rol";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_perfil($usu_id,$usu_clave,$usu_direccion,$usu_tel){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios 
                    SET 
                    usu_clave = ?,
                    usu_direccion = ?, 
                    usu_tel = ?
                    WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_clave);
            $sql->bindValue(2,$usu_direccion);
            $sql->bindValue(3,$usu_tel);
            $sql->bindValue(4,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_usuario($usu_id, $usu_usuario,$usu_clave,$usu_nombre,$usu_apellidos,$usu_email,$car_id,$usu_pensum,$rol_id,$usu_direccion,$usu_tel,$per_id,$usu_sede){
            $conectar=parent::Conexion();
            parent::set_names();
            $sql="UPDATE usuarios
                SET
                    usu_usuario = ?,
                    usu_clave = ?,
                    usu_nombre = ?,
                    usu_apellidos = ?,
                    usu_email = ?,
                    car_id = ?,
                    usu_pensum = ?,
                    rol_id = ?,
                    usu_direccion = ?,
                    usu_tel = ?,
                    per_id = ?,
                    usu_sede = ?
                WHERE
                    usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_usuario);
            $sql->bindValue(2, $usu_clave);
            $sql->bindValue(3, $usu_nombre);
            $sql->bindValue(4, $usu_apellidos);
            $sql->bindValue(5, $usu_email);
            $sql->bindValue(6, $car_id);
            $sql->bindValue(7, $usu_pensum);
            $sql->bindValue(8, $rol_id);
            $sql->bindValue(9, $usu_direccion);
            $sql->bindValue(10, $usu_tel);
            $sql->bindValue(11, $per_id);
            $sql->bindValue(12, $usu_sede);
            $sql->bindValue(13, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET est=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT
                usuarios.usu_id,
                usuarios.usu_usuario,
                usuarios.usu_clave,
                usuarios.usu_nombre,
                usuarios.usu_apellidos,
                usuarios.usu_email,
                usuarios.car_id,
                usuarios.usu_sede,
                usuarios.estado,
                carreras.car_id,
                carreras.car_snies,
                carreras.car_nombre,
                rol.rol_id,
                rol.rol_nombre
              FROM usuarios
              INNER JOIN rol on usuarios.rol_id = rol.rol_id
              INNER JOIN carreras on usuarios.car_id = carreras.car_id
            ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuario_id($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios WHERE estado = 1 AND usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function carreras(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM carreras WHERE estado = 1 ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function rol() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM rol";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function total_profesores(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM usuarios WHERE rol_id=3 AND estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_programas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM carreras WHERE estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_activos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM usuarios WHERE rol_id = 2 AND estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_inactivos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM usuarios WHERE rol_id = 2 AND estado=0";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function total_estudiantes(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT count(*) as total FROM usuarios WHERE rol_id =2";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_estadoActivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET estado=1 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
        public function update_estadoInactivo($usu_id){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE usuarios SET estado=0 WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuarios_estudiantes(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios WHERE rol_id=2 AND estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function usuarios_profesores(){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM usuarios WHERE rol_id=3 AND estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }