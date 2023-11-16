<?php
    require_once("../config/conexion.php");
    require_once("../models/Periodos.php");
    $periodos = new Periodos();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["per_id"])){
                    $periodos->insert_periodo($_POST["per_nombre"]);
                }else{
                    $periodos->update_periodo($_POST["per_id"], $_POST["per_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $periodos->periodos_id($_POST["per_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["per_id"] = $row["per_id"];
                        $output["per_nombre"] = $row["per_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $periodos->delete_periodo($_POST["per_id"]);
                break;
        case "listar":
                $datos=$periodos->periodos();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["per_nombre"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["per_id"].');"  id="'.$row["per_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["per_id"].');"  id="'.$row["per_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$periodos->periodos();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['per_id']."'>".$row['per_nombre']."</option>";
                }
                echo $html;
            }
            break;
            
     
    }
?>