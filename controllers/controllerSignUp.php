<?php

class ControllerSignUp{

    private $signup;
    private $table;

    public function __construct(){  

        require_once ("models/modeloSignUp.php");
        $this->table = 'usuarios';
        $this->signup = new modeloSignUp($this->table);
    }


    // Realiza el proceso para el signUp
    public function registrarUsuario(){

        if(!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['rol'])){
            
            $message = '';

            $usuario = $_POST['usuario'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //CIFRADO
            $rol = $_POST['rol'];

            $result= $this->signup->registrarUsuario($usuario, $password, $rol);

            if ( $result ) {
                $result2 = $this->signup->validarRegistro( $usuario );
                $id_usuario = $result2['id_usuario'];
                $table_rol = '';
                $nombres = $_POST['nombres'];
                $cedula = $_POST['cedula'];
                $correo = $_POST['correo'];
                $ciudad = $_POST['ciudad'];
                $telefono = $_POST['telefono'];

                if ($rol == 1){
                    $table_rol = 'profesores';                     
                } else{
                    $table_rol = 'estudiantes'; 
                }

                $result3 = $this->signup->registrarDatosSegunRol( $table_rol, $nombres, $cedula, $correo, $ciudad, $telefono, $id_usuario );

                if ($result3){
                    $message = 'Usuario creado satisfactoriamente';
                } else {
                    $message = 'No se pudo guardar';
                }
            } 
            else {

                $message = 'Sorry there must have been an issue creating your account';

            }
               
            }

            require_once("views/viewSignup.phtml");

        }

}

 


?>
