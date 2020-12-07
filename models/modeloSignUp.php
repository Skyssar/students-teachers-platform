<?php
class modeloSignUp{
    
    private $table;
    private $conectar;
    private $db;
 
    public function __construct($table){  
        $this->table = (string) $table;

        //require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
    }

    public function validarRegistro( $usuario ){

        $query = "SELECT id_usuario FROM $this->table WHERE username = '$usuario'";

        $consulta=$this->db->query($query);
        $result = mysqli_fetch_array($consulta);
            return $result;
            
    }

    public function registrarUsuario( $username, $password, $id_rol ){

        $query = "INSERT INTO $this->table (username, password, id_rol) 
                    VALUES ('$username', '$password', '$id_rol')";

        $consulta=$this->db->query($query);

        return $consulta;
    }

    public function registrarDatosSegunRol( $table_rol, $nombres, $cedula, $correo, $ciudad, $telefono, $id_usuario ){

        $query = "INSERT INTO $table_rol (nombres, cedula, correo, ciudad, telefono, id_usuario) 
                    VALUES ('$nombres', '$cedula', '$correo', '$ciudad', '$telefono', '$id_usuario')";

        $consulta=$this->db->query($query);

        return $consulta;
    }

    



}
?>