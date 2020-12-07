<?php

class ControllerPreguntas{

    private $preguntas;
    private $table;

    public function __construct(  ){  
        
        require_once ("models/modeloPreguntas.php");
        $this->table = 'preguntas';
        $this->preguntas = new modeloPreguntas($this->table);
        
    }

    public function crearPregunta( $id_lectura ){

        $numero_preguntas = $this->preguntas->obtenerCantidadPreguntas($id_lectura)+1;

        // valida si se envió el formulario
        if (isset ($_POST['correcta'])){

            $pregunta = $_POST['pregunta'];
            $a = $_POST['a'];
            $b = $_POST['b'];
            $c = $_POST['c'];
            $d = $_POST['d'];
            $correcta = $_POST['correcta']; 

            $message = '';

            $consulta = $this->preguntas->guardarPregunta($numero_preguntas, $pregunta, $a, $b, $c, $d, $correcta, $id_lectura);

            if ($consulta){
                    $message = "Pregunta guardada con éxito";
                    $numero_preguntas += 1;
                } else{
                    $message = "No se pudo guardar";
                }
        
    }

            require_once("views/viewsDocente/viewPreguntas.phtml");

   
    }

    public function editarPregunta( $id_lectura, $id_pregunta ){

        $numero_preguntas= '';

        if ( isset ($_POST['correcta']) ){

            $pregunta = $_POST['pregunta'];
            $a = $_POST['a'];
            $b = $_POST['b'];
            $c = $_POST['c'];
            $d = $_POST['d'];
            $correcta = $_POST['correcta']; 

            $message = '';
             
            $consulta = $this->preguntas->updatePregunta($id_pregunta, $pregunta, $a, $b, $c, $d, $correcta);

            if ( $consulta ){

                $message = "PREGUNTA ACTUALIZADA"; // MESSAGE (ADD MODAL OR ALERT)

            }
            else{
                $message =  "NO SE PUDO ACTUALIZAR";
            }

        }
        require_once("views/viewsDocente/viewPreguntas.phtml");


    }


}


 


?>
