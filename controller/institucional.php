<?php
    require_once("../config/conexion.php");
    require_once("../models/Institucional.php");
    $institucional = new Institucional();

    require_once("../models/InsEstudiante.php");
    $pregInsEst = new InsEstudiante();

    require_once("../models/InsProfesor.php");
    $pregInsPro = new InsProfesor();

    
    $usu_id = $_SESSION["usu_id"];
    
    switch($_GET["opc"]){
        case "guardar":
                $preguntas=$pregInsEst->insEstudiantes();
                foreach($preguntas as $row){
                    $institucional->insert_institucional($_POST["usu_id"],$row["pei_pregunta"],$_POST["eva_respuesta_{$row['pei_id']}"]);
                }
                break; 
        case "guardar2":
            $preguntas=$pregInsEst->insEstudiantes();
            foreach($preguntas as $row){
                $institucional->insert_institucional($_POST["usu_id"],$row["pei_pregunta"],$_POST["eva_respuesta_{$row['pei_id']}"]);
            }
            break; 
        case "total_evaluaciones_institucionales":
            $datos=$institucional->total_realizadasIns();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "total_evaluaciones_auto":
            $datos=$institucional->total_realizadasAuto();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        case "listar":
                $datos=$institucional->listar($usu_id);
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    
                    $sub_array[] = $row["mat_codigo"] ." - ".$row["mat_nombre"] ;
                    //$sub_array[] = $row["usu_id"];
                    $sub_array[] = $row["auto_pregunta"] ;
                    $sub_array[] = $row["auto_respuesta"] ;
                    $sub_array[] = $row["usu_id"];
                    if($row["auto_estado"] == 1){
                        $sub_array[] = "<button type='button' class='btn btn-danger btn-sm'>No realizada</button>";
                    }else{
                        $sub_array[] = "<button type='button' class='btn btn-primary btn-sm'>Realizada</button>";
                    }
                
                    $sub_array[] = '<a href="mntAutEstudiante.php"> <button type="button" class="btn btn-outline-dark btn-icon"><i class="bx bx-edit-alt"></i></button></a>';
                    
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