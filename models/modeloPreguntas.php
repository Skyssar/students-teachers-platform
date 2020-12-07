<?php
class modeloPreguntas{
    
    private $table;
    private $conectar;
    private $db;
 
    public function __construct($table){  
        $this->table = (string) $table;

        //require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
    }

    public function guardarPregunta($numero, $pregunta, $a, $b, $c, $d, $correcta, $id_lectura){

        $query= "INSERT INTO $this->table(numero_pregunta, pregunta, respuesta_a, respuesta_b, respuesta_c, respuesta_d, correcta, id_lectura) 
                VALUES ('$numero', '$pregunta', '$a', '$b', '$c', '$d', '$correcta', '$id_lectura')";

        $consulta = $this->db->query($query);

        return $consulta;
            
    }

    public function obtenerCantidadPreguntas( $id_lectura ){

        $query = "SELECT COUNT(*) FROM $this->table WHERE id_lectura = '$id_lectura'";

        $consulta= $this->db->query($query);

        if ($consulta){
            $result = mysqli_fetch_array($consulta);
            return $result[0];
        } else{
            return false;
        }
       
    }

    public function obtenerPreguntas( $id_lectura ){

        $query = "SELECT * FROM $this->table WHERE id_lectura = '$id_lectura'";

        $consulta= $this->db->query($query);

        if ($consulta){
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        } else{
            return false;
        }


    }

    public function getOnePregunta( $id_pregunta ){

        $query = "SELECT * FROM $this->table WHERE id_pregunta = $id_pregunta";

        $consulta = $this->db->query($query);

        return mysqli_fetch_assoc($consulta);

    }

    public function deletePregunta( $id_pregunta ){

        $query = "DELETE FROM $this->table WHERE id_pregunta = '$id_pregunta'";

        $consulta = $this->db->query($query);

        return $consulta;


    }

    public function updatePregunta( $id_pregunta, $pregunta, $a, $b, $c, $d, $correcta ){

        $query = "UPDATE $this->table SET pregunta = '$pregunta', respuesta_a = '$a', 
                    respuesta_b = '$b', respuesta_c = '$c', respuesta_d = '$d', correcta = '$correcta'
                 WHERE id_pregunta = $id_pregunta";

        $consulta = $this->db->query($query);

        return $consulta;
    }



    



}
?>