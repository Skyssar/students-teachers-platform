<?php

require '../models/modeloLecturas.php';
require '../models/modeloPreguntas.php';
require '../models/modeloActividades.php';
require_once '../db/db.php';
        
$lecturas = new modeloLecturas('lecturas');
$preguntas = new modeloPreguntas('preguntas');
$actividades = new modeloActividades();

// Obtenemos el id
preg_match_all('!\d+!', $_SERVER['REQUEST_URI'], $matches);

if ( count($matches[0]) == 1 ){
    $id = $matches[0][0];
} else if ( count($matches[0]) == 2 ){
    $id = $matches[0][0]; 
    $id2 = $matches[0][1];
}


// Endpoints

if ( $_SERVER['REQUEST_METHOD'] == 'GET'){
    
    switch ($_SERVER['REQUEST_URI']){

        case '/projects/projectfinal/api/lecturas': // TODAS LAS LECTURAS GUARDADAS EN DB   
        
            $respuesta = $lecturas->getLecturas();
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/'.$id."/lecturas": // LAS LECTURAS DE UN DOCENTE SEGUN SU ID
        
            $respuesta = $lecturas->getLecturas2Profesor( $id );
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/lecturas/'.$id: // UNA LECTURA ESPECÍFICA
        
            $respuesta = $lecturas->getOneLectura( $id );
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/lecturas/'.$id."/preguntas": // LAS PREGUNTAS DE UNA LECTURA ESPECÍFICA
        
            $respuesta = $preguntas->obtenerPreguntas( $id );
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/preguntas/'.$id: // UNA PREGUNTA ESPECÍFICA
        
            $respuesta = $preguntas->getOnePregunta( $id );
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/'.$id."/actividades": // LAS ACTIVIDADES DE UN GRADO ESPECIFICO
        
            $respuesta = $actividades->getLecturasGrado( $id );
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/notas/'.$id: // LAS NOTAS SEGUN EL ID DEL DOCENTE
        
            $respuesta = $actividades->getNotasDocente( $id );
            echo json_encode ($respuesta);

        break;  

        case '/projects/projectfinal/api/notas_estudiante/'.$id: // LAS NOTAS SEGUN EL ID DEL ESTUDIANTE
        
            $respuesta = $actividades->getNotasEstudiante( $id );
            echo json_encode ($respuesta);

        break; 
      
        case '/projects/projectfinal/api/lecturas/'.$id."/estudiante"."/"."$id2"."/respuestas": // LAS RESPUESTAS DE UNA LECTURA
        
            $respuesta = $actividades->obtenerPreguntas_Respuestas( $id, $id2 );
            echo json_encode ($respuesta);

        break;




        default: echo "No disponible";

    }

}

if ( $_SERVER['REQUEST_METHOD'] == "DELETE"){
    
    switch ($_SERVER['REQUEST_URI']){

        case '/projects/projectfinal/api/lecturas/'.$id: // 
        
            $lectura = $lecturas->getOneLectura( $id );
            if ( $lectura ){
                $respuesta = $lecturas->deleteLectura( $id ); 
            }
            echo json_encode ($respuesta);

        break;

        case '/projects/projectfinal/api/lecturas/'.$id.'/preguntas'.'/'.$id2: // 
        
            $pregunta = $preguntas->getOnePregunta( $id2 );
            if ( $pregunta ){
                $respuesta = $preguntas->deletePregunta( $id2 ); 
            }
            echo json_encode ($respuesta);

        break;

        default: echo "xD";

    }

}








?>