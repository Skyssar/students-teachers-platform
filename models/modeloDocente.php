<?php
// MODELO DEL DOCENTE
class modeloDocente{
    
    private $table;
    private $conectar;
    private $db;
    private $usuario;
    private $grados; 
  
    public function __construct($table){  
        $this->table = (string) $table;
        $this->usuario = "";
        $this->grados=array();

      //  require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
    }

    public function getGradosDocente( $id_profesor ){

        $query = "SELECT grado.id_grado, grado.code FROM grado INNER JOIN 
            (profesores p INNER JOIN grado_profesor ON p.id_profesor = grado_profesor.id_profesor) 
            ON grado.id_grado = grado_profesor.code_grado WHERE p.id_profesor ='$id_profesor'";

        $consulta=$this->db->query($query);
        
        if ($consulta){
            $grados = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
            }

        return $grados;

    }

    public function getIdProfesor( $id_usuario ){

        $query = "SELECT id_profesor FROM profesores WHERE id_usuario = '$id_usuario'";

        $consulta=$this->db->query($query);
        
        if ($consulta){
            $result = mysqli_fetch_array($consulta);
            return $result[0];
        } 
        else
        {
            return false;
        }

    }





}
?>