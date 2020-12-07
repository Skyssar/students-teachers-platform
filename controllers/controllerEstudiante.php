<?php
// CONTROLADOR DEL ESTUDIANTE
class ControllerEstudiante{

    private $table;
    private $estudiante;

    public function __construct(){  
        require_once ("models/modeloEstudiante.php");
        $this->table = 'usuarios';
        $this->estudiante = new modeloEstudiante($this->table);
    }

    public function pagInicio (){
        
        session_start();

        if(!isset($_SESSION['rol'])){  
            header('location: index.php');
        } else{
            if($_SESSION['rol'] != 2){
                header('location: index.php');
            }
        }
        
        $usuario = $_SESSION['username'];
        $id_usuario = $_SESSION['id_usuario'];

        $consulta = $this->estudiante->getGradoEstudiante( $id_usuario );
        
        if ($consulta != null){ 

            $grado = $consulta['code'];
            $_SESSION['id_grado']= $consulta['id_grado'];
            $_SESSION['grado']= $grado;
            $_SESSION['id_estudiante']= $consulta['id_estudiante'];
        }
        else{
            $grado= "No tiene grado asignado";
        }
        require_once("views/viewsEstudiante/viewInicio.phtml");

    }


    public function CerrarSesión(){

        session_start();
        session_destroy();
        header("location: index.php");
        exit();

    }


}
 


?>