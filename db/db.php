<?php

class Conexion{    

    private $host ;
    private $usuario;
    private $clave;
    private $db;
    private $charset;

    public function __construct(){
        $this->host = 'localhost';
        $this->db = 'lecturas';
        $this->usuario = 'root';
        $this->password = '';
        $this->charset = 'utf8';
    }

    public function connect(){
            $con = new mysqli($this->host, $this->usuario, $this->password,$this->db);
            $con->query("SET NAMES '".$this->charset."'");
            return $con;
    }
 
}

?>
