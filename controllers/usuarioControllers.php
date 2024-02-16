<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/usuarioModels.php");
    /*TODO: Inicializando Clase */
    $usuario = new usuarioModels();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){

        /*TODO: MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
        case "listar_cursos":
            $datos=$usuario->get_cursos_x_usuario($_POST["usuarioId"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cursoNombre"];
                $sub_array[] = $row["cursoFechaInicio"];
                $sub_array[] = $row["cursoFechaFin"];
                $sub_array[] = $row["instructorNombre"]." ".$row["instructorApellidoPaterno"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["detallecursoId"].');"  id="'.$row["detallecursoId"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        /*TODO: MicroServicio para poder mostrar el listado de cursos de un usuario con certificado */
        case "listar_cursos_top10":
            $datos=$usuario->get_cursos_x_usuario_top10($_POST["usuarioId"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cursoNombre"];
                $sub_array[] = $row["cursoFechaInicio"];
                $sub_array[] = $row["cursoFechaFin"];
                $sub_array[] = $row["instructorNombre"]." ".$row["instructorApellidoPaterno"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["detallecursoId"].');"  id="'.$row["detallecursoId"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        /*TODO: Microservicio para mostar informacion del certificado con el detallecursoId */
        case "mostrar_curso_detalle":
            $datos = $usuario->get_curso_x_id_detalle($_POST["detallecursoId"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["detallecursoId"] = $row["detallecursoId"];
                    $output["cursoId"] = $row["cursoId"];
                    $output["cursoNombre"] = $row["cursoNombre"];
                    $output["cursoDescripcion"] = $row["cursoDescripcion"];
                    $output["cursoFechaInicio"] = $row["cursoFechaInicio"];
                    $output["cursoFechaFin"] = $row["cursoFechaFin"];
                    $output["cursoImagen"] = $row["cursoImagen"];
                    $output["usuarioId"] = $row["usuarioId"];
                    $output["usuarioNombre"] = $row["usuarioNombre"];
                    $output["usuarioApellidoPaterno"] = $row["usuarioApellidoPaterno"];
                    $output["usuarioApellidoMaterno"] = $row["usuarioApellidoMaterno"];
                    $output["instructorId"] = $row["instructorId"];
                    $output["instructorNombre"] = $row["instructorNombre"];
                    $output["instructorApellidoPaterno"] = $row["instructorApellidoPaterno"];
                    $output["instructorApellidoMaterno"] = $row["instructorApellidoMaterno"];
                }

                echo json_encode($output);
            }
            break;
        /*TODO: Total de Cursos por usuario para el dashboard */
        case "total":
            $datos=$usuario->get_total_cursos_x_usuario($_POST["usuarioId"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Mostrar informacion del usuario en la vista perfil */
        case "mostrar":
            $datos = $usuario->get_usuario_x_id($_POST["usuarioId"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usuarioId"] = $row["usuarioId"];
                    $output["usuarioNombre"] = $row["usuarioNombre"];
                    $output["usuarioApellidoPaterno"] = $row["usuarioApellidoPaterno"];
                    $output["usuarioApellidoMaterno"] = $row["usuarioApellidoMaterno"];
                    $output["usuarioCorreo"] = $row["usuarioCorreo"];
                    $output["usuarioSexo"] = $row["usuarioSexo"];
                    $output["usuarioPassword"] = $row["usuarioPassword"];
                    $output["usuarioTelefono"] = $row["usuarioTelefono"];
                    $output["usuarioRolId"] = $row["usuarioRolId"];
                    /* $output["usuarioDni"] = $row["usuarioDni"]; */
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Mostrar informacion segun DNI del usuario registrado */
        case "consulta_dni":
            $datos = $usuario->get_usuario_x_dni($_POST["usuarioDni"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["usuarioId"] = $row["usuarioId"];
                    $output["usuarioNombre"] = $row["usuarioNombre"];
                    $output["usuarioApellidoPaterno"] = $row["usuarioApellidoPaterno"];
                    $output["usuarioApellidoMaterno"] = $row["usuarioApellidoMaterno"];
                    $output["usuarioCorreo"] = $row["usuarioCorreo"];
                    $output["usuarioSexo"] = $row["usuarioSexo"];
                    $output["usuarioPassword"] = $row["usuarioPassword"];
                    $output["usuarioTelefono"] = $row["usuarioTelefono"];
                    $output["usuarioRolId"] = $row["usuarioRolId"];
                    $output["usuarioDni"] = $row["usuarioDni"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Actualizar datos de perfil */
        case "update_perfil":
            $usuario->update_usuario_perfil(
                $_POST["usuarioId"],
                $_POST["usuarioNombre"],
                $_POST["usuarioApellidoPaterno"],
                $_POST["usuarioApellidoMaterno"],
                $_POST["usuarioPassword"],
                $_POST["usuarioSexo"],
                $_POST["usuarioTelefono"]
            );
            break;
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["usuarioId"])){
                $usuario->insert_usuario($_POST["usuarioNombre"],$_POST["usuarioApellidoPaterno"],$_POST["usuarioApellidoMaterno"],$_POST["usuarioCorreo"],$_POST["usuarioPassword"],$_POST["usuarioSexo"],$_POST["usuarioTelefono"],$_POST["usuarioRolId"]/* ,$_POST["usuarioDni"] */);
            }else{
                $usuario->update_usuario($_POST["usuarioId"],$_POST["usuarioNombre"],$_POST["usuarioApellidoPaterno"],$_POST["usuarioApellidoMaterno"],$_POST["usuarioCorreo"],$_POST["usuarioPassword"],$_POST["usuarioSexo"],$_POST["usuarioTelefono"],$_POST["usuarioRolId"]/* ,$_POST["usuarioDni"] */);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $usuario->delete_usuario($_POST["usuarioId"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
                $datos=$usuario->get_usuario();
                $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["usuarioNombre"];
                    $sub_array[] = $row["usuarioApellidoPaterno"];
                    $sub_array[] = $row["usuarioApellidoMaterno"];
                    $sub_array[] = $row["usuarioCorreo"];
                    $sub_array[] = $row["usuarioTelefono"];
                    if ($row["usuarioRolId"]==1) {
                        $sub_array[] = "Usuario";
                    }else{
                        $sub_array[] = "Admin";
                    }
                    $sub_array[] = '<button type="button" onClick="editar('.$row["usuarioId"].');"  id="'.$row["usuarioId"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                    $sub_array[] = '<button type="button" onClick="eliminar('.$row["usuarioId"].');"  id="'.$row["usuarioId"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                    $data[] = $sub_array;
                }

                $results = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>count($data),
                    "iTotalDisplayRecords"=>count($data),
                    "aaData"=>$data);
                echo json_encode($results);
                break;
        /*TODO: Listar todos los usuarios pertenecientes a un curso */
        case "listar_cursos_usuario":
            $datos=$usuario->get_cursos_usuario_x_id($_POST["cur_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["cursoNombre"];
                $sub_array[] = $row["usuarioNombre"]." ".$row["usuarioApellidoPaterno"]." ".$row["usuarioApellidoMaterno"];
                $sub_array[] = $row["cursoFechaInicio"];
                $sub_array[] = $row["cursoFechaFin"];
                $sub_array[] = $row["instructorNombre"]." ".$row["instructorApellidoPaterno"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["detallecursoId"].');"  id="'.$row["detallecursoId"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["detallecursoId"].');"  id="'.$row["detallecursoId"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_detalle_usuario":
            $datos=$usuario->get_usuario_modal($_POST["cursoId"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "<input type='checkbox' name='detallecheck[]' value='". $row["usuarioId"] ."'>";
                $sub_array[] = $row["usuarioNombre"];
                $sub_array[] = $row["usuarioApellidoPaterno"];
                $sub_array[] = $row["usuarioApellidoMaterno"];
                $sub_array[] = $row["usuarioCorreo"];
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "guardar_desde_excel":
            $usuario->insert_usuario($_POST["usuarioNombre"],$_POST["usuarioApellidoPaterno"],$_POST["usuarioApellidoMaterno"],$_POST["usuarioCorreo"],$_POST["usuarioPassword"],$_POST["usuarioSexo"],$_POST["usuarioTelefono"],$_POST["usuarioRolId"]/* ,$_POST["usuarioDni"] */);
            break;

    }
