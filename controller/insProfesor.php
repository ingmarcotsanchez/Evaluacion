<?php
    require_once("../config/conexion.php");
    require_once("../models/InsProfesor.php");
    $insProfesor = new InsProfesor();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["ppi_id"])){
                    $insProfesor->insert_insProfesor($_POST["ppi_pregunta"]);
                }else{
                    $insProfesor->update_insProfesor($_POST["ppi_id"], $_POST["ppi_pregunta"]);
                }
                break;
        case "mostrar":
                $datos = $insProfesor->insProfesor_id($_POST["ppi_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["ppi_id"] = $row["ppi_id"];
                        $output["ppi_pregunta"] = $row["ppi_pregunta"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $insProfesor->delete_insProfesor($_POST["pei_id"]);
                break;
        case "listar":
                $datos=$insProfesor->insProfesores();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["ppi_pregunta"];
                    if($row["estado"] == '1'){
                        $sub_array[] = "<button type='button' onClick='preina(".$row["ppi_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='preact(".$row["ppi_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["ppi_id"].');"  id="'.$row["ppi_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["ppi_id"].');"  id="'.$row["ppi_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$insProfesor->insProfesores();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['ppi_id']."'>".$row['ppi_pregunta']."</option>";
                }
                echo $html;
            }
            break;
        case "activo":
            $insProfesor->update_estadoActivo($_POST["ppi_id"]);
            break;
        case "inactivo":
            $insProfesor->update_estadoInactivo($_POST["ppi_id"]);
            break;
        case "guardar_desde_excel":
            $insProfesor->insert_insProfesor($_POST["ppi_pregunta"]);
            break;
            
     
    }
?>