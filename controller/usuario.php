<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    require_once("../models/Carreras.php");
    $usuario = new Usuario();
    $carrera = new Carreras();
    switch($_GET["opc"]){
        case "inputselectRol":
            $datos = $usuario->rol();
            if(is_array($datos)==true and count($datos)<>0){
                $html = "<option label='Seleccione un rol'></option>";
                foreach($datos as $row){
                    $html .= "<option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
                }
                echo $html;
            }
            break;
    
        case "guardaryeditar":
            if(empty($_POST["usu_id"])){
                //$curso es la variable que tenemos inicializada, los metodos son los que creamos en el archivo de models
                $usuario->insert_usuario($_POST["usu_usuario"],$_POST["usu_clave"],$_POST["usu_nombre"],$_POST["usu_apellidos"],$_POST["usu_email"],$_POST["car_id"],$_POST["usu_pensum"],$_POST["rol_id"],$_POST["usu_direccion"],$_POST["usu_tel"],$_POST["per_id"],$_POST["usu_sede"]);
            }else{
                $usuario->update_usuario($_POST["usu_id"],$_POST["usu_usuario"],$_POST["usu_clave"],$_POST["usu_nombre"],$_POST["usu_apellidos"],$_POST["usu_email"],$_POST["car_id"],$_POST["usu_pensum"],$_POST["rol_id"],$_POST["usu_direccion"],$_POST["usu_tel"],$_POST["per_id"],$_POST["usu_sede"]);
            }
            break;
        case "mostrar":
            $datos = $usuario->usuario_id($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_usuario"] = $row["usu_usuario"];
                    $output["usu_clave"] = $row["usu_clave"];
                    $output["usu_nombre"] = $row["usu_nombre"];
                    $output["usu_apellidos"] = $row["usu_apellidos"];
                    $output["usu_email"] = $row["usu_email"];
                    $output["car_id"] = $row["car_id"];
                    $output["usu_pensum"] = $row["usu_pensum"];
                    $output["rol_id"] = $row["rol_id"];
                    $output["usu_direccion"] = $row["usu_direccion"];
                    $output["usu_tel"] = $row["usu_tel"];
                    $output["per_id"] = $row["per_id"];
                    $output["usu_sede"] = $row["usu_sede"];
                    $output["estado"] = $row["estado"];
                }
                echo json_encode($output);
            }
            break;
        case "eliminar":
            $usuario->delete_usuario($_POST["usu_id"]);
            break;
        case "listar":
            $datos=$usuario->listar();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = $row["usu_usuario"];
                $sub_array[] = $row["usu_nombre"] ." ". $row["usu_apellidos"];
                $sub_array[] = $row["usu_email"];
                $sub_array[] = $row["rol_nombre"];
                //$sub_array[] = $row["car_id"];
                $sub_array[] = $row["car_nombre"];
                if($row["usu_sede"] == "B"){
                    $sub_array[] = "Bogotá";
                }elseif ($row["usu_sede"] == "G"){
                    $sub_array[] = "Girardot";
                }else{
                    $sub_array[] = "Sin sede";
                }
                if($row["estado"] == '1'){
                    $sub_array[] = "<button type='button' onClick='usuina(".$row["usu_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                }else{
                    $sub_array[] = "<button type='button' onClick='usuact(".$row["usu_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                }
                $sub_array[] = '<button type="button" onClick="editar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                
                $data[] = $sub_array;
            }
            /*Formato del datatable, se usa siempre*/
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        case "editPerfil":
            $usuario->update_perfil($_POST["usu_id"],$_POST["usu_clave"],$_POST["usu_direccion"],$_POST["usu_tel"]);
            break;
        case "total_Profesores":
            $datos=$usuario->total_profesores();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_estudiantes":
            $datos=$usuario->total_estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_activos":
            $datos=$usuario->total_activos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_inactivos":
            $datos=$usuario->total_inactivos();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "activo":
            $usuario->update_estadoActivo($_POST["usu_id"]);
            break;
        case "inactivo":
            $usuario->update_estadoInactivo($_POST["usu_id"]);
            break;
        case "guardar_desde_excel":
            $usuario->insert_usuario($_POST["usu_usuario"],$_POST["usu_clave"],$_POST["usu_nombre"],$_POST["usu_apellidos"],$_POST["usu_email"],$_POST["car_id"],$_POST["usu_pensum"],$_POST["rol_id"],$_POST["usu_direccion"],$_POST["usu_tel"],$_POST["per_id"],$_POST["usu_sede"]);
            break;
        case "combo_estudiantes":
            $datos=$usuario->usuarios_estudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nombre']." ".$row['usu_apellidos']."</option>";
                }
                echo $html;
            }
            break;
        case "combo_profesores":
            $datos=$usuario->usuarios_profesores();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nombre']." ".$row['usu_apellidos']."</option>";
                }
                echo $html;
            }
            break;

        case "total_carrerass":
            $datos=$carrera->total_carreras();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
            
        
    }
?>