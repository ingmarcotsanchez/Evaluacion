<?php
    require_once("../config/conexion.php");
    require_once("../models/Asignaturas.php");
    $asignatura = new Asignatura();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["mat_id"])){
                    $asignatura->insert_asignatura($_POST["car_id"],$_POST["mat_codigo"],$_POST["mat_nombre"]);
                }else{
                    $asignatura->update_asignatura($_POST["mat_id"], $_POST["car_id"],$_POST["mat_codigo"],$_POST["mat_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $asignatura->asignaturas_id($_POST["mat_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["mat_id"] = $row["mat_id"];
                        $output["car_id"] = $row["car_id"];
                        $output["mat_codigo"] = $row["mat_codigo"];
                        $output["mat_nombre"] = $row["mat_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $asignatura->delete_asignatura($_POST["mat_id"]);
                break;
        case "listar":
                $datos=$asignatura->asignaturas2();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["car_nombre"];
                    $sub_array[] = $row["mat_codigo"];
                    $sub_array[] = $row["mat_nombre"];
                    if($row["estado"] == 1){
                        $sub_array[] = "<button type='button' onClick='matina(".$row["mat_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='matact(".$row["mat_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["mat_id"].');"  id="'.$row["mat_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["mat_id"].');"  id="'.$row["mat_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
            $datos=$asignatura->asignaturas();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['mat_id']."'>".$row['mat_codigo']." ".$row['mat_nombre']."</option>";
                }
                echo $html;
            }
            break;
        case "guardar_desde_excel":
            $asignatura->insert_asignatura($_POST["car_id"],$_POST["mat_codigo"],$_POST["mat_nombre"]);
            break;
        case "activo":
            $carrera->update_estadoActivo($_POST["mat_id"]);
            break;
        case "inactivo":
            $carrera->update_estadoInactivo($_POST["mat_id"]);
            break;

        case "listar_asignaturas":
            $datos=$asignatura->asignaturas_mantenimiento($_POST["usu_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                //columnas de las tablas a mostrar segun select del modelo
                $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='". $row["mat_id"] ."'>";
                $sub_array[] = $row["mat_codigo"];
                $sub_array[] = $row["mat_nombre"];
                
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