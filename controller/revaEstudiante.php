<?php
    require_once("../config/conexion.php");
    require_once("../models/REvaEstudiante.php");
    $revaEstudiante = new REvaEstudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["rea_id"])){
                    $revaEstudiante->insert_revaEstudiante($_POST["pea_id"],$_POST["rea_respuesta"]);
                }else{
                    $revaEstudiante->update_revaEstudiante($_POST["rea_id"],$_POST["pea_id"], $_POST["rea_respuesta"]);
                }
                break;
        case "mostrar":
                $datos = $revaEstudiante->revaEstudiante_id($_POST["rea_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["rea_id"] = $row["rea_id"];
                        $output["pea_id"] = $row["pea_id"];
                        $output["rea_respuesta"] = $row["rea_respuesta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $revaEstudiante->delete_revaEstudiante($_POST["rea_id"]);
                break;
        case "listar":
                $datos=$revaEstudiante->revaEstudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["pea_pregunta"];
                    $sub_array[] = $row["rea_respuesta"];
                    if($row["estado"] == 1){
                        $sub_array[] = "<button type='button' onClick='reina(".$row["rea_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='react(".$row["rea_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["rea_id"].');"  id="'.$row["rea_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["rea_id"].');"  id="'.$row["rea_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
        case "activo":
            $revaEstudiante->update_estadoActivo($_POST["rea_id"]);
            break;
        case "inactivo":
            $revaEstudiante->update_estadoInactivo($_POST["rea_id"]);
            break;
        case "guardar_desde_excel":
            $revaEstudiante->insert_revaEstudiante($_POST["pea_id"],$_POST["rea_respuesta"]);
            break;
            
     
    }
?>