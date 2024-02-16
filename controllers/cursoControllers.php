<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/cursoModels.php");
    /*TODO: Inicializando Clase */
    $curso = new cursoModels();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["cursoId"])){
                $curso->insert_curso($_POST["cursoCategoriaId"],$_POST["cursoNombre"],$_POST["cursoDescripcion"],$_POST["cursoFechaInicio"],$_POST["cursoFechaFin"],$_POST["cursoInstructorId"]);
            }else{
                $curso->update_curso($_POST["cursoId"],$_POST["cursoCategoriaId"],$_POST["cursoNombre"],$_POST["cursoDescripcion"],$_POST["cursoFechaInicio"],$_POST["cursoFechaFin"],$_POST["cursoInstructorId"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $curso->get_curso_id($_POST["cursoId"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["cursoId"] = $row["cursoId"];
                    $output["cursoCategoriaId"] = $row["cursoCategoriaId"];
                    $output["cursoNombre"] = $row["cursoNombre"];
                    $output["cursoDescripcion"] = $row["cursoDescripcion"];
                    $output["cursoFechaInicio"] = $row["cursoFechaInicio"];
                    $output["cursoFechaFin"] = $row["cursoFechaFin"];
                    $output["cursoInstructorId"] = $row["cursoInstructorId"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $curso->delete_curso($_POST["cursoId"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$curso->get_curso();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["categoriaNombre"];
                $sub_array[] = '<a href="'.$row["cursoImagen"].'" target="_blank">'.strtoupper($row["cursoNombre"]).'</a>';
                $sub_array[] = $row["cursoFechaInicio"];
                $sub_array[] = $row["cursoFechaFin"];
                $sub_array[] = $row["instructorNombre"] ." ". $row["instructorApellidoPaterno"] ." ". $row["instructorApellidoMaterno"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cursoId"].');"  id="'.$row["cursoId"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cursoId"].');"  id="'.$row["cursoId"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $sub_array[] = '<button type="button" onClick="imagen('.$row["cursoId"].');"  id="'.$row["cursoId"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';                
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
            $datos=$curso->get_curso();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['cursoId']."'>".$row['cursoNombre']."</option>";
                }
                echo $html;
            }
            break;

        case "eliminar_curso_usuario":
            $curso->delete_curso_usuario($_POST["detallecursoId"]);
            break;
        /*TODO: Insetar detalle de curso usuario */
        case "insert_curso_usuario":
            /*TODO: Array de usuario separado por comas */
            $datos = explode(',', $_POST['usu_id']);
            /*TODO: Registrar tantos usuarios vengan de la vista */
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $idx=$curso->insert_curso_usuario($_POST["cur_id"],$row);
                $sub_array[] = $idx;
                $data[] = $sub_array;
            }

            echo json_encode($data);
            break;

        case "generar_qr":
            require 'phpqrcode/qrlib.php';
            //Primer Parametro - Text del QR
            //Segundo Parametro - Ruta donde se guardara el archivo
            QRcode::png(conectar::ruta()."view/Certificado/index.php?detallecursoId=".$_POST["detallecursoId"],"../public/qr/".$_POST["detallecursoId"].".png",'L',32,5);
            break;

        case "update_imagen_curso":
            $curso->update_imagen_curso($_POST["curx_idx"],@$_POST["cursoImagen"]);
            break;
    }
