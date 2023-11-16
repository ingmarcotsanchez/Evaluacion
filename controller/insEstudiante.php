<?php
    require_once("../config/conexion.php");
    require_once("../models/InsEstudiante.php");
    $insEstudiante = new InsEstudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["pei_id"])){
                    $insEstudiante->insert_insEstudiante($_POST["pei_pregunta"]);
                }else{
                    $insEstudiante->update_insEstudiante($_POST["pei_id"], $_POST["pei_pregunta"]);
                }
                break;
        case "mostrar":
                $datos = $insEstudiante->insEstudiante_id($_POST["pei_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["pei_id"] = $row["pei_id"];
                        $output["pei_pregunta"] = $row["pei_pregunta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $insEstudiante->delete_insEstudiante($_POST["pei_id"]);
                break;
        case "listar":
                $datos=$insEstudiante->insEstudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["pei_pregunta"];
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='preina(".$row["pei_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='preact(".$row["pei_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["pei_id"].');"  id="'.$row["pei_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["pei_id"].');"  id="'.$row["pei_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$insEstudiante->insEstudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['pei_id']."'>".$row['pei_pregunta']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $insEstudiante->update_estadoActivo($_POST["pei_id"]);
            break;
        case "inactivo":
            $insEstudiante->update_estadoInactivo($_POST["pei_id"]);
            break;
        case "guardar_desde_excel":
            $insEstudiante->insert_insEstudiante($_POST["pei_pregunta"]);
            break;
            
     
    }
?>