<?php
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    require_once("../models/Autoevaluacion.php");
    require_once("../models/Institucional.php");

    $usuario = new Usuario();
    $autoevaluacion = new Autoevaluacion();
    $institucional = new Institucional();

    switch($_GET["opc"]){
        case "mostrar_Ins":
            $datos = $institucional->realizadas($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["eva_id"] = $row["eva_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["eva_pregunta"] = $row["eva_pregunta"];
                    $output["eva_respuesta"] = $row["eva_respuesta"];
                    $output["eva_estado"] = $row["eva_estado"];
                }
                echo json_encode($output);
            }
            break;
        case "mostrar_Aut":
            $datos = $institucional->realizadas($_POST["usu_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["auto_id"] = $row["auto_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["mat_id"] = $row["mat_id"];
                    $output["auto_pregunta"] = $row["auto_pregunta"];
                    $output["auto_respuesta"] = $row["auto_respuesta"];
                    $output["auto_estado"] = $row["auto_estado"];
                }
                echo json_encode($output);
            }
            break;
    }
    