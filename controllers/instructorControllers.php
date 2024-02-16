<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/instructorModels.php");
    /*TODO: Inicializando Clase */
    $instructorr = new instructorModels();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["instructorId"])){
                $instructorr->insert_instructor($_POST["instructorNombre"],$_POST["instructorApellidoPaterno"],$_POST["instructorApellidoMaterno"],$_POST["instructorCorreo"],$_POST["instructorSexo"],$_POST["instructorTelefono"]);
            }else{
                $instructorr->update_instructor($_POST["instructorId"],$_POST["instructorNombre"],$_POST["instructorApellidoPaterno"],$_POST["instructorApellidoMaterno"],$_POST["instructorCorreo"],$_POST["instructorSexo"],$_POST["instructorTelefono"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $instructorr->get_instructor_id($_POST["instructorId"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["instructorId"] = $row["instructorId"];
                    $output["instructorNombre"] = $row["instructorNombre"];
                    $output["instructorApellidoPaterno"] = $row["instructorApellidoPaterno"];
                    $output["instructorApellidoMaterno"] = $row["instructorApellidoMaterno"];
                    $output["instructorCorreo"] = $row["instructorCorreo"];
                    $output["instructorSexo"] = $row["instructorSexo"];
                    $output["instructorTelefono"] = $row["instructorTelefono"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $instructorr->delete_instructor($_POST["instructorId"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$instructorr->get_instructor();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["instructorNombre"];
                $sub_array[] = $row["instructorApellidoPaterno"];
                $sub_array[] = $row["instructorApellidoMaterno"];
                $sub_array[] = $row["instructorCorreo"];
                $sub_array[] = $row["instructorTelefono"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["instructorId"].');"  id="'.$row["instructorId"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["instructorId"].');"  id="'.$row["instructorId"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "combo":
            $datos=$instructorr->get_instructor();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['instructorId']."'>".$row['instructorNombre']." ".$row['instructorApellidoPaterno']." ".$row['instructorApellidoMaterno']."</option>";
                }
                echo $html;
            }
            break;
    }
?>