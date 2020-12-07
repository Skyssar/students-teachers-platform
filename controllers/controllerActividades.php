<?php

class ControllerActividades{

    private $actividades;

    public function __construct(){  
        require_once ("models/modeloActividades.php");
        $this->actividades = new modeloActividades();
    }

    public function listarLecturasGrado(){

        session_start();
        if(isset ($_SESSION['id_grado'])){

            $id_grado = $_SESSION['id_grado'];  
       
        } 
        
        require_once("views/viewsEstudiante/viewActividades.phtml");
               
    }

   
    public function realizarActividad( $id_lectura ){

        if (isset($_POST['1'])){
            
            session_start();
            $size = count($_POST);
            $contador_for_nota = 0;

            $preguntas = $this->actividades->getIdPreguntas( $id_lectura ); //obtiene los id de las preguntas de la actividad

            for ( $i =1; $i <= $size; ++$i ){

                $status = $this->actividades->verificarRespuestas( $preguntas[$i-1], $_POST[$i] );

                $insertar = $this->actividades->guardarPregunta( $_SESSION['id_estudiante'], $id_lectura, $preguntas[$i-1], $_POST[$i], $status );
                
                if ( $status == 1 ){
                    $contador_for_nota += 1;
                }
            } 

            $nota = ($contador_for_nota/$size) * 5;
            $agregarnota = $this->actividades->agregarNota( $id_lectura, $_SESSION['id_estudiante'], $nota );
            
            header("location: index.php?controller=actividades&accion=respuestas&id=".$id_lectura."");
            
        }

        require_once("views/viewsEstudiante/viewRealizarActividad.phtml");

    }

    public function revisarRespuestas( $id_lectura ){
       
            session_start();
            $id_estudiante = $_SESSION['id_estudiante'];

            $nota = $this->actividades->getNota( $id_lectura, $id_estudiante );

            $nota = number_format($nota, 1, ".", "");  

        require_once("views/viewsEstudiante/viewResultados.phtml");

    }

    public function listaNotas(  ){
       
        session_start();
        $id_profesor = $_SESSION['id_profesor'];

    require_once("views/viewsDocente/viewReporte.phtml");

}

    public function listaNotasEstudiante( ){

        session_start();
        if(isset ($_SESSION['id_grado'])){

            $id_grado = $_SESSION['id_grado'];  
            $id_estudiante = $_SESSION['id_estudiante'];
  
        }
       
        require_once("views/viewsEstudiante/viewNotas.phtml");

    }




}


?>
