<?php
    require_once("../config/conexion.php");
    require_once("../models/Carreras.php");
    $carrera = new Carreras();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["car_id"])){
                    $carrera->insert_carrera($_POST["car_snies"],$_POST["car_nombre"],$_POST["car_tipo"],$_POST["car_sede"]);
                }else{
                    $carrera->update_carrera($_POST["car_id"], $_POST["car_snies"],$_POST["car_nombre"],$_POST["car_tipo"],$_POST["car_sede"]);
                }
                break;
        case "mostrar":
                $datos = $carrera->carreras_id($_POST["car_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["car_id"] = $row["car_id"];
                        $output["car_snies"] = $row["car_snies"];
                        $output["car_nombre"] = $row["car_nombre"];
                        $output["car_tipo"] = $row["car_tipo"];
                        $output["car_sede"] = $row["car_sede"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $carrera->delete_carrera($_POST["car_id"]);
                break;
        case "listar":
                $datos=$carrera->carreras();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["car_snies"];
                    $sub_array[] = $row["car_nombre"];
                    if($row["car_tipo"] == 'MA'){
                        $sub_array[] = "Maestría";
                    }elseif ($row["car_tipo"] == 'ES'){
                        $sub_array[] = "Especialización";
                    }elseif ($row["car_tipo"] == 'PP'){
                        $sub_array[] = "Profesional";
                    }elseif ($row["car_tipo"] == 'TL'){
                        $sub_array[] = "Técnico Laboral";
                    }elseif ($row["car_tipo"] == 'TP'){
                        $sub_array[] = "Técnico Profesional";
                    }else{
                        $sub_array[] = "Sin rol";
                    }
                    if($row["car_sede"] == 'B'){
                        $sub_array[] = "Bogotá";
                    }else{
                        $sub_array[] = "Girardot";
                    }
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='carina(".$row["car_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='caract(".$row["car_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["car_id"].');"  id="'.$row["car_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["car_id"].');"  id="'.$row["car_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
        case "combo":
            $datos=$carrera->carreras();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['car_id']."'>".$row['car_snies']." ".$row['car_nombre']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $carrera->update_estadoActivo($_POST["car_id"]);
            break;
        case "inactivo":
            $carrera->update_estadoInactivo($_POST["car_id"]);
            break;
        case "guardar_desde_excel":
            $carrera->insert_carrera($_POST["car_snies"],$_POST["car_nombre"],$_POST["car_tipo"],$_POST["car_sede"]);
            break;
        case "total_carreras":
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