<?php
    require_once("../config/conexion.php");
    require_once("../models/RInsProfesor.php");
    $rinsProfesor = new RInsProfesor();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["rei_id"])){
                    $rinsProfesor->insert_rinsProfesor($_POST["ppi_id"],$_POST["rpi_respuesta"]);
                }else{
                    $rinsProfesor->update_rinsProfesor($_POST["rpi_id"],$_POST["ppi_id"], $_POST["rpi_respuesta"]);
                }
                break;
        case "mostrar":
                $datos = $rinsProfesor->rinsProfesor_id($_POST["rpi_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["rpi_id"] = $row["rpi_id"];
                        $output["ppi_id"] = $row["ppi_id"];
                        $output["rpi_respuesta"] = $row["rpi_respuesta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $rinsProfesor->delete_rinsProfesor($_POST["rpi_id"]);
                break;
        case "listar":
                $datos=$rinsProfesor->rinsProfesores();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["ppi_pregunta"];
                    $sub_array[] = $row["rpi_respuesta"];
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='preina(".$row["rpi_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='preact(".$row["rpi_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["rpi_id"].');"  id="'.$row["rpi_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["rpi_id"].');"  id="'.$row["rpi_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$rinsProfesor->rinsProfesores();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['rpi_id']."'>".$row['rpi_pregunta']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $rinsProfesor->update_estadoActivo($_POST["rpi_id"]);
            break;
        case "inactivo":
            $rinsProfesor->update_estadoInactivo($_POST["rpi_id"]);
            break;
        case "guardar_desde_excel":
            $rinsProfesor->insert_rinsProfesor($_POST["ppi_id"],$_POST["rpi_respuesta"]);
            break;
            
     
    }
?>