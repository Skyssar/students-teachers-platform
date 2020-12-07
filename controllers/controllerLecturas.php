<?php

class ControllerLecturas{

    private $lecturas;
    private $table;

    public function __construct(){  
        require_once ("models/modeloLecturas.php");
        $this->table = 'lecturas';
        $this->lecturas = new modeloLecturas($this->table);
    }

    public function listarLecturas(){

        session_start();
        $id_profesor = $_SESSION['id_profesor'];
        
        require_once("views/viewsDocente/viewListaLecturas.phtml");
        
    }

    public function crearLectura(){

        session_start();
        $grados = $_SESSION['grados'];

        if (isset ($_POST['titulo']) && isset ($_POST['contenido'])){

            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $id_grado = $_POST['id_grado'];
            $id_docente = $_SESSION['id_profesor'];

            $_SESSION['lectura_actual'] = $_POST['titulo']; 

            $message = '';

            $consulta = $this->lecturas->agregarLectura($titulo, $contenido, $id_docente, $id_grado);

            if ($consulta){
                $lectura_actual = $this->lecturas->getLecturaActual( );
                $_SESSION['id_lectura_actual'] = $lectura_actual['id_lectura']; 

            /* if($consulta){
                    $message = "Lectura guardada con éxito";
                } */

                header("location: index.php?controller=preguntas&accion=crear&id=".$lectura_actual['id_lectura']."");
                

        }
    }

        require_once("views/viewsDocente/viewCrearLectura.phtml");
    }

    public function editarLectura( $id_lectura ){

        session_start();
        $grados = $_SESSION['grados'];

        if ( isset ($_POST['titulo']) && isset ($_POST['contenido']) && isset ($_POST['id_grado']) ){

            $titulo = $_POST['titulo'];
            $contenido = $_POST['contenido'];
            $id_grado = $_POST['id_grado'];
             
            $consulta = $this->lecturas->updateLectura($id_lectura, $titulo, $contenido, $id_grado);

            if ( $consulta ){

                $message = "LECTURA ACTUALIZADA"; // MESSAGE (ADD MODAL OR ALERT)

            }
            else{
                $message =  "NO SE PUDO ACTUALIZAR";
            }

        }
        require_once("views/viewsDocente/viewDetallesLectura.phtml");

    }




}


?>
