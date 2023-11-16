<?php
    require_once("../config/conexion.php");
    require_once("../models/RInsEstudiante.php");
    $rinsEstudiante = new RInsEstudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["rei_id"])){
                    $rinsEstudiante->insert_rinsEstudiante($_POST["pei_id"],$_POST["rei_respuesta"]);
                }else{
                    $rinsEstudiante->update_rinsEstudiante($_POST["rei_id"],$_POST["pei_id"], $_POST["rei_respuesta"]);
                }
                break;
        case "mostrar":
                $datos = $rinsEstudiante->rinsEstudiante_id($_POST["rei_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["rei_id"] = $row["rei_id"];
                        $output["pei_id"] = $row["pei_id"];
                        $output["rei_respuesta"] = $row["rei_respuesta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $rinsEstudiante->delete_rinsEstudiante($_POST["rei_id"]);
                break;
        case "listar":
                $datos=$rinsEstudiante->rinsEstudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["pei_pregunta"];
                    $sub_array[] = $row["rei_respuesta"];
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='preina(".$row["rei_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='preact(".$row["rei_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["rei_id"].');"  id="'.$row["rei_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["rei_id"].');"  id="'.$row["rei_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$rinsEstudiante->rinsEstudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['rei_id']."'>".$row['rei_pregunta']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $rinsEstudiante->update_estadoActivo($_POST["rei_id"]);
            break;
        case "inactivo":
            $rinsEstudiante->update_estadoInactivo($_POST["rei_id"]);
            break;
        case "guardar_desde_excel":
            $rinsEstudiante->insert_rinsEstudiante($_POST["pei_id"],$_POST["rei_respuesta"]);
            break;
            
     
    }
?>