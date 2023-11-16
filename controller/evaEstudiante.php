<?php
    require_once("../config/conexion.php");
    require_once("../models/EvaEstudiante.php");
    $evaEstudiante = new EvaEstudiante();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["pea_id"])){
                    $evaEstudiante->insert_evaEstudiante($_POST["pea_pregunta"]);
                }else{
                    $evaEstudiante->update_evaEstudiante($_POST["pea_id"], $_POST["pea_pregunta"]);
                }
                break;
        case "mostrar":
                $datos = $evaEstudiante->evaEstudiante_id($_POST["pea_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["pea_id"] = $row["pea_id"];
                        $output["pea_pregunta"] = $row["pea_pregunta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $evaEstudiante->delete_evaEstudiante($_POST["pea_id"]);
                break;
        case "listar":
                $datos=$evaEstudiante->evaEstudiantes();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["pea_pregunta"];
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='preina(".$row["pea_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='preact(".$row["pea_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["pea_id"].');"  id="'.$row["pea_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["pea_id"].');"  id="'.$row["pea_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$evaEstudiante->evaEstudiantes();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['pea_id']."'>".$row['pea_pregunta']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $evaEstudiante->update_estadoActivo($_POST["pea_id"]);
            break;
        case "inactivo":
            $evaEstudiante->update_estadoInactivo($_POST["pea_id"]);
            break;
        case "guardar_desde_excel":
            $evaEstudiante->insert_evaEstudiante($_POST["pea_pregunta"]);
            break;
        case "evaluadas":
            $datos=$evaEstudiante->evaluadas();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                
                $sub_array[] = $row["mat_codigo"] ." - ".$row["mat_nombre"] ;
                $sub_array[] = $row["grupo"];
                $sub_array[] = $row["usu_id"];
                if($row["estado"] == 1){
                    $sub_array[] = "<button type='button' class='btn btn-danger btn-sm'>No realizada</button>";
                }else{
                    $sub_array[] = "<button type='button' class='btn btn-primary btn-sm'>Realizada</button>";
                }
            
                $sub_array[] = '<button type="button" onClick="editar('.$row["matr_id"].');"  id="'.$row["matr_id"].'" class="btn btn-outline-success btn-icon">Evaluar</button>';
                
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
            
     
    }
?>