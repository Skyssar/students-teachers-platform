<?php
// Actividades del estudiante
class modeloActividades{
    
    private $tablelecturas;
    private $tablepreguntas;
    private $tablerespuestas;
    private $tablenotas;
    private $conectar;
    private $db;
 
    public function __construct(){  

     //   require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
        $this->tablelecturas = "lecturas";
        $this->tablepreguntas = "preguntas";
        $this->tablerespuestas = "respuestas_estudiantes";
        $this->tablenotas = "notas_estudiante";
    }

    public function getLecturasGrado( $id_grado ){

        //$query = "SELECT * FROM $this->tablelecturas l INNER JOIN profesores p 
        //            ON l.id_profesor = p.id_profesor WHERE l.id_grado = '$id_grado'
        //            ORDER BY l.id_lectura DESC";

        $query = "SELECT l.titulo, l.fecha, p.nombres, l.id_lectura, n.nota 
                FROM ($this->tablelecturas l INNER JOIN profesores p ON l.id_profesor = p.id_profesor) 
                LEFT JOIN $this->tablenotas n  ON n.id_lectura = l.id_lectura WHERE l.id_grado = '$id_grado'
                 ORDER BY l.id_lectura DESC";

        $consulta = $this->db->query($query);

        if ($consulta){
                    
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);

        } 
        else {

            return false;
        }
    }

    public function getPreguntasLectura( $id_lectura ){

        $query = "SELECT * FROM $this->tablepreguntas WHERE id_lectura = '$id_lectura'";

        $consulta = $this->db->query($query);

        if ($consulta){
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        } else{
            return false;
        }

    }

    // Retorna los id de las preguntas en un array
    public function getIdPreguntas( $id_lectura ){

        $query = "SELECT id_pregunta FROM $this->tablepreguntas WHERE id_lectura = '$id_lectura'";

        $consulta = $this->db->query($query);

        if ($consulta){
            $response = mysqli_fetch_all($consulta, MYSQLI_ASSOC);
           
            foreach($response as $fila){
                $id_preguntas[]=$fila['id_pregunta'];
                }
                return $id_preguntas;
        } else{
            return false;
        }

    }

    public function guardarPregunta( $id_estudiante, $id_lectura, $id_pregunta, $respuesta, $status ){

        $query = "INSERT INTO $this->tablerespuestas(id_estudiante, id_lectura, id_pregunta, respuesta, status) 
        VALUES ('$id_estudiante', '$id_lectura', '$id_pregunta', '$respuesta', '$status')";

        $consulta = $this->db->query($query);

        return $consulta;

    }

    public function verificarRespuestas( $id_pregunta, $respuesta ){

        $query = "SELECT COUNT(*) FROM $this->tablepreguntas WHERE id_pregunta = '$id_pregunta' 
                    AND correcta = '$respuesta'";
        
        $consulta= $this->db->query($query);

        if ($consulta){
            $result = mysqli_fetch_array($consulta);
            return $result[0];
        } else{
            return false;
        }



    }

    public function obtenerPreguntas_Respuestas( $id_lectura, $id_estudiante ){

        $query = "SELECT * FROM $this->tablepreguntas p INNER JOIN $this->tablerespuestas r 
                ON p.id_pregunta = r.id_pregunta WHERE p.id_lectura = '$id_lectura' AND r.id_estudiante = '$id_estudiante'
                ORDER BY p.numero_pregunta";

        $consulta= $this->db->query($query);

        if ($consulta){
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        } else{
            return false;
        }

    }

    public function agregarNota( $id_lectura, $id_estudiante, $nota ){

        $query = "INSERT INTO $this->tablenotas(id_lectura, id_estudiante, nota) 
                 VALUES ('$id_lectura', '$id_estudiante', '$nota')";

        $consulta= $this->db->query($query);

        if ($consulta){
            return $true;
        } else{
            return false;
        }


    }

    public function getNota ( $id_lectura, $id_estudiante ){

        $query = "SELECT * FROM $this->tablenotas 
                WHERE id_lectura = '$id_lectura' AND id_estudiante = '$id_estudiante'
                ORDER BY nota DESC LIMIT 1";

        $consulta= $this->db->query($query);   
        
        if ($consulta){
            $info = mysqli_fetch_assoc($consulta);
            return $info['nota'];
        } else{
            return false;
        }

    }

    public function getNotasDocente ( $id_docente ){

        $query = "SELECT * FROM lecturas l INNER JOIN (estudiantes e INNER JOIN notas_estudiante n ON 
                e.id_estudiante = n.id_estudiante) ON l.id_lectura = n.id_lectura 
                WHERE l.id_profesor = '$id_docente'";

        $consulta= $this->db->query($query);   
        
        if ($consulta){
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
        } else{
            return false;
        }

    }

    public function getNotasEstudiante ( $id_estudiante ){

        $query = "SELECT * FROM ($this->tablelecturas l INNER JOIN profesores p ON l.id_profesor = p.id_profesor) 
                LEFT JOIN $this->tablenotas n  ON n.id_lectura = l.id_lectura WHERE n.id_estudiante='$id_estudiante'
                 ORDER BY l.id_lectura DESC";

        $consulta = $this->db->query($query);

        if ($consulta){
                    
            return mysqli_fetch_all($consulta, MYSQLI_ASSOC);

        } 
        else {

            return false;
        }
    }


}
?>