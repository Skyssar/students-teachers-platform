<?php
require_once("db/db.php");
/*require_once("controllers/personas_controller.php");*/

if (isset ($_GET['controller']) && isset ($_GET['accion'])){

    if ($_GET['controller'] == "docente"){

    require_once ("controllers/controllerDocente.php");
    $controlador= new ControllerDocente();

        switch ($_GET['accion']){

            case 'inicio':
                $controlador->pagInicio();
            break;

            case 'salir':
                $controlador->CerrarSesión();
            break;

        }

    }

    if ($_GET['controller'] == "lecturas"){

        require_once ("controllers/controllerLecturas.php");
        $controlador= new ControllerLecturas();
    
        switch ($_GET['accion']){
    
            case 'lista':
                $controlador->listarLecturas();
            break;
    
            case 'crear':
                $controlador->crearLectura();
            break;

            case 'editar':
                if (isset ($_GET['id'])){

                    $id = $_GET['id']; // guardamos la id del GET
                    $controlador->editarLectura( $id );
                }
            break;
            
    
        }
    
        }

        if ($_GET['controller'] == "preguntas"){

            require_once ("controllers/controllerPreguntas.php");
            $controlador= new ControllerPreguntas();

            if (isset ($_GET['id'])){

                $id = $_GET['id']; // guardamos la id del GET
        
                switch ($_GET['accion']){
        
                    case 'crear':
                        $controlador->crearPregunta( $id );
                    break;

                    case 'editar':
                        $id_lectura = $_GET['id_lectura'];
                        $controlador->editarPregunta( $id_lectura, $id );
                    break;
            
                }
            }
        
        }

        if ($_GET['controller'] == "estudiante"){

            require_once ("controllers/controllerEstudiante.php");
            $controlador= new ControllerEstudiante();
        
                switch ($_GET['accion']){
        
                    case 'inicio':
                        $controlador->pagInicio();
                    break;
        
                    case 'salir':
                        $controlador->CerrarSesión();
                    break;
        
                }
        
        }

        if ($_GET['controller'] == "actividades"){

            require_once ("controllers/controllerActividades.php");
            $controlador= new ControllerActividades();


        
                switch ($_GET['accion']){
        
                    case 'lecturas':
                        $controlador->listarLecturasGrado();
                    break;
        
                    case 'realizar':
                        if (isset ($_GET['id'])){

                            $id = $_GET['id']; // guardamos la id del GET
                            $controlador->realizarActividad( $id );
                        }
                    break;

                    case 'respuestas':
                        if (isset ($_GET['id'])){

                            $id = $_GET['id']; // guardamos la id del GET
                            $controlador->revisarRespuestas( $id );
                        }
                    break;

                    case 'listanotas':
                            $controlador->listaNotas( );
                    break;

                    case 'misnotas':
                        $controlador->listaNotasEstudiante( );
                    break;
    
        
                }
        
        }



    

    }




if (isset ($_GET['accion'])){

    switch ($_GET['accion']){
    
        case 'signup':
            require_once ("controllers/controllerSignUp.php");
            $controlador= new ControllerSignUp();

            $controlador->registrarUsuario();

        break;

        case 'verificacion':
            require_once ("controllers/controllerLogin.php");
            $controlador= new ControllerLogin();

            $controlador->validacionDosPasos();


        break;



    }



}

else {

    require_once ("controllers/controllerLogin.php");
    $controlador= new ControllerLogin();

    $controlador->verificarLogin();
    $controlador->login();


}
?>
