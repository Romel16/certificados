<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/categoriaModels.php");
    /*TODO: Inicializando Clase */
    $categoria = new categoriaModels();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["categoriaId"])){
                $categoria->insert_categoria($_POST["categoriaNombre"]);
            }else{
                $categoria->update_categoria($_POST["categoriaId"],$_POST["categoriaNombre"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $categoria->get_categoria_id($_POST["categoriaId"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["categoriaId"] = $row["categoriaId"];
                    $output["categoriaNombre"] = $row["categoriaNombre"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $categoria->delete_categoria($_POST["categoriaId"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$categoria->get_categoria();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["categoriaNombre"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["categoriaId"].');"  id="'.$row["categoriaId"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["categoriaId"].');"  id="'.$row["categoriaId"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
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
            $datos=$categoria->get_categoria();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['categoriaId']."'>".$row['categoriaNombre']."</option>";
                }
                echo $html;
            }
            break;
    }
?>