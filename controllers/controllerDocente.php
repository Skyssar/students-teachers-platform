<?php
// CONTROLADOR DEL DOCENTE
class ControllerDocente{

    private $table;
    private $docente;
    private $cLecturas;

    public function __construct(){  
        require_once ("models/modeloDocente.php");

        $this->table = 'usuarios';
        $this->docente = new modeloDocente($this->table);
    }

    public function pagInicio (){
        
        session_start();

        if(!isset($_SESSION['rol'])){  
            header('location: index.php');
        } else{
            if($_SESSION['rol'] != 1){
                header('location: index.php');
            }
        }
        
        $usuario = $_SESSION['username'];
        $id_usuario = $_SESSION['id_usuario'];
        $id_profesor = $this->docente->getIdProfesor( $id_usuario );
        

        $grados = $this->docente->getGradosDocente( $id_profesor );

        $_SESSION['grados'] = $grados; 
        $_SESSION['id_profesor'] = $id_profesor;

        require_once("views/viewsDocente/viewInicio.phtml");

    }



    public function CerrarSesión(){

        session_start();
        session_destroy();
        header("location: index.php");
        exit();

    }


}
 


?>