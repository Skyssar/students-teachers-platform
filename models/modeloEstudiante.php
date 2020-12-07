<?php
// MODELO DEL ESTUDIANTE
class modeloEstudiante{
    
    private $table;
    private $conectar;
    private $db;
    private $usuario;
    private $grado; 
  
    public function __construct($table){  
        $this->table = (string) $table;
        $this->usuario = "";
        $this->grado=array();

      //  require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
    }

    public function getGradoEstudiante( $id_estudiante ){

        $query = "SELECT e.id_grado, g.code, e.id_estudiante FROM estudiantes e INNER JOIN grado g 
                    ON e.id_usuario = '$id_estudiante' WHERE e.id_grado = g.id_grado";

        $consulta=$this->db->query($query);
        
        if ($consulta){
                $grado = mysqli_fetch_assoc($consulta);
            }

        return $grado;

    }



}
?>