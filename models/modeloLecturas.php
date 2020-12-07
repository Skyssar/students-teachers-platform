<?php
class modeloLecturas{
    
    private $table;
    private $conectar;
    private $db;
    private $lecturas;
 
    public function __construct($table){  
        $this->table = (string) $table;

     //   require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
        $this->lecturas=array();
    }

    public function getLecturas(){

        $consulta=$this->db->query("SELECT * FROM $this->table");
        if ($consulta){
            foreach($consulta as $fila){
                $this->lecturas[]=$fila;
                }
            return $this->lecturas;
            }
    }

    public function agregarLectura($titulo, $contenido, $id_profesor, $id_grado){

        $query = "INSERT INTO $this->table(titulo, contenido, id_profesor, id_grado) 
                VALUES ('$titulo','$contenido', '$id_profesor', '$id_grado')";

        $consulta = $this->db->query($query);

        return $consulta;

    }

    public function getOneLectura( $id_lectura ){

        $query = "SELECT * FROM $this->table l LEFT JOIN grado ON l.id_grado = grado.id_grado 
                    WHERE id_lectura = $id_lectura";

        $consulta = $this->db->query($query);

        return mysqli_fetch_assoc($consulta);

    }

    public function getLecturaActual( ){

        $query = "SELECT * FROM $this->table ORDER BY id_lectura DESC LIMIT 1";

        $consulta = $this->db->query($query);

        return mysqli_fetch_array($consulta);

    }

    // las lecturas segun el id del profesor
    public function getLecturas2Profesor( $id_profesor ){

        $consulta=$this->db->query("SELECT * FROM $this->table l INNER JOIN grado ON l.id_grado = grado.id_grado   
                                    WHERE id_profesor = '$id_profesor' ORDER BY l.id_lectura DESC");

        if ($consulta){
            
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        }
        
    }

    public function deleteLectura( $id_lectura ){

        $query = "DELETE FROM $this->table WHERE id_lectura = '$id_lectura'";

        $consulta = $this->db->query($query);

        return $consulta;


    }

    public function updateLectura( $id_lectura, $titulo, $contenido, $id_grado ){

        $query = "UPDATE $this->table SET titulo = '$titulo', contenido = '$contenido', id_grado = '$id_grado'
                 WHERE id_lectura = $id_lectura";

        $consulta = $this->db->query($query);

        return $consulta;
    }
}
?>

