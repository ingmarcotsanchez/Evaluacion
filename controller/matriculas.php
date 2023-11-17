<?php
    require_once("../config/conexion.php");
    require_once("../models/Matriculas.php");
    $matriculas = new Matriculas();
    require_once("../models/Autoevaluacion.php");
    $autoevaluacion = new Autoevaluacion();
    $usu_id = $_SESSION["usu_id"];

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["matr_id"])){
                    $matriculas->insert_matricula($_POST["mat_id"],$_POST["usu_id_est"],$_POST["grupo"],$_POST["usu_id_pro"]);
                }else{
                    $matriculas->update_matricula($_POST["matr_id"], $_POST["mat_id"],$_POST["usu_id_est"],$_POST["grupo"],$_POST["usu_id_pro"]);
                }
                break;
        case "mostrar":
                $datos = $matriculas->matriculas_id($_POST["matr_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["matr_id"] = $row["matr_id"];
                        $output["mat_id"] = $row["mat_id"];
                        $output["usu_id_est"] = $row["usu_id_est"];
                        $output["grupo"] = $row["grupo"];
                        $output["usu_id_pro"] = $row["usu_id_pro"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $matriculas->delete_matricula($_POST["matr_id"]);
                break;
        case "matriculas":
                $datos=$matriculas->matriculadas($usu_id);
                $data=Array();
                $datos1=$autoevaluacion->listar($usu_id);
                $data1=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    
                    $sub_array[] = $row["mat_codigo"] ." - ".$row["mat_nombre"] ;
                    $sub_array[] = $row["grupo"];
                  
                    $sub_array[] = $row["usu_nombre"] ." ".$row["usu_apellidos"] ;
                    if($datos == 0){
                        $sub_array[] = "<b class='text-success'>Realizada</b>";
                    
                        $sub_array[] = '<button disabled type="button" onClick="evaluar('.$row["mat_id"].');"  id="'.$row["mat_id"].'" class="btn btn-warning btn-sm">Evaluar</button>';
                    }else{
                        $sub_array[] = "<b class='text-danger'>No Realizada</b>";
                        $sub_array[] = '<button type="button" onClick="evaluar('.$row["mat_id"].');"  id="'.$row["mat_id"].'" class="btn btn-warning btn-sm">Evaluar</button>';
                    }
                }
                    $data[] = $sub_array;
                
                /*Formato del datatable, se usa siempre*/
                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                
                break;
        case "listar":
                $datos=$matriculas->matriculacion();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    
                    $sub_array[] = $row["mat_codigo"] ." - ".$row["mat_nombre"] ;
                    //$sub_array[] = $row["usu_id"];
                    $sub_array[] = $row["usu_nombre"] ." ".$row["usu_apellidos"] ;
                    $sub_array[] = $row["grupo"];
                    /*if($_SESSION["rol_id"] == $row["rol_id"]){
                        $sub_array[] = $row["usu_nombre"] ." ".$row["usu_apellidos"] ;
                    }*/
                    $sub_array[] = $row["usu_nombre"] ." ".$row["usu_apellidos"] ;
                    if($row["estado"] == 1){
                        $sub_array[] = "<button type='button' onClick='matrina(".$row["matr_id"].");' class='btn btn-primary btn-sm'>Activo</button>";
                    }else{
                        $sub_array[] = "<button type='button' onClick='matract(".$row["matr_id"].");' class='btn btn-danger btn-sm'>Inactivo</button>";
                    }
                
                    $sub_array[] = '<button type="button" onClick="editar('.$row["matr_id"].');"  id="'.$row["matr_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["matr_id"].');"  id="'.$row["matr_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
        
        case "guardar_desde_excel":
            $matriculas->insert_matricula($_POST["mat_id"],$_POST["usu_id_est"],$_POST["grupo"],$_POST["usu_id_pro"]);
            break;
        case "activo":
            $matriculas->update_estadoActivo($_POST["matr_id"]);
            break;
        case "inactivo":
            $matriculas->update_estadoInactivo($_POST["matr_id"]);
            break;
     
    }
?>