<?php
    require_once("../config/conexion.php");
    require_once("../models/Autoevaluacion.php");
    $autoevaluacion = new Autoevaluacion();

    require_once("../models/EvaEstudiante.php");
    $pregEvaEst = new EvaEstudiante();

    require_once("../models/Asignaturas.php");
    $asig = new Asignatura();

  
    $usu_id = $_SESSION["usu_id"];

    switch($_GET["opc"]){
        case "guardar":
                $preguntas=$pregEvaEst->evaEstudiantes();
                foreach($preguntas as $row){
                    $autoevaluacion->insert_autoevaluacion($_POST["usu_id"],$row["pea_pregunta"],$_POST["auto_respuesta_{$row['pea_id']}"]);
                }   
                break; 
        case "listar":
                $datos=$autoevaluacion->listar($usu_id);
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