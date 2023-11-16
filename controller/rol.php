<?php
    require_once("../config/conexion.php");
    require_once("../models/Rol.php");
    $rol = new Rol();

    switch($_GET["opc"]){
        case "guardaryeditar":
                if(empty($_POST["rol_id"])){
                    $rol->insert_rol($_POST["rol_nombre"]);
                }else{
                    $rol->update_rol($_POST["rol_id"], $_POST["rol_nombre"]);
                }
                break;
        case "mostrar":
                $datos = $rol->roles_id($_POST["rol_id"]);
                if(is_array($datos)==true and count($datos)<>0){
                    foreach($datos as $row){
                        $output["rol_id"] = $row["rol_id"];
                        $output["rol_nombre"] = $row["rol_nombre"];
                    }
                    echo json_encode($output);
                }
                break;
        case "eliminar":
                $rol->delete_rol($_POST["rol_id"]);
                break;
        case "listar":
                $datos=$rol->roles();
                $data=Array();
                foreach($datos as $row){
                    $sub_array = array();
                    //columnas de las tablas a mostrar segun select del modelo
                    $sub_array[] = $row["rol_nombre"];
                    $sub_array[] = '<button type="button" onClick="editar('.$row["rol_id"].');"  id="'.$row["rol_id"].'" class="btn btn-outline-success btn-icon"><i class="bx bx-edit-alt"></i></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["rol_id"].');"  id="'.$row["rol_id"].'" class="btn btn-outline-danger btn-icon"><i class="bx bx-trash"></i></button>';
                    
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
                $datos=$rol->roles();
                if(is_array($datos)==true and count($datos)>0){
                    $html= " <option label='Seleccione'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
                    }
                    echo $html;
                }
                break;
            
     
    }
?>