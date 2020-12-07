<?php

class ControllerLogin{

    private $login;
    private $table;

    public function __construct(){  

        require_once ("models/modeloLogin.php");
        $this->table = 'usuarios';
        $this->login = new modeloLogin($this->table);
    }

    // Verifica si el usuario ya tiene una sesión iniciada
    public function verificarLogin(){ 
        
        session_start();
        
        if (isset($_SESSION['rol'])) {
            
            switch($_SESSION['rol']){

                case 1:
                    header('location: ?controller=docente&accion=inicio');
                break;

                case 2:
                    header('location: ?controller=estudiante&accion=inicio');
                break;

                default:
            }
        }
    }   

    // Realiza el proceso para el login
    public function login(){

        if(isset($_POST['usuario']) && isset($_POST['password'])){
            
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $result= $this->login->validarLogin($usuario);

            $message = '';

            if ( $result && password_verify($_POST['password'], $result['password'] ) ){
            
                //$_SESSION['rol'] = $result['id_rol'];
                $_SESSION['username'] = $usuario;
                $_SESSION['id_usuario'] = $result['id_usuario'];

                header('location: ?accion=verificacion');   

            }else{
                // no existe el usuario o no coincide la contraseña
                $message = 'Usuario o contraseña incorrectos';
            } 

            }
                require_once("views/viewLogin.phtml");
    }


    public function validacionDosPasos( ){

        session_start();
    
        $id_usuario = $_SESSION['id_usuario'];

        if ( isset($_POST['token']) ){

            $info= $this->login->getInfoUsuario( $id_usuario );

            if ( $info['token'] == $_POST['token'] ){

                $_SESSION['rol'] = $info['id_rol'];

                header('location: index.php');                       
  

            } else{

               $message = "CÓDIGO INCORRECTO";

            }

        } else{

            $codigo = rand(100000, 999999);
    
            $result= $this->login->insertarToken( $id_usuario, $codigo );
            $data_rol = $this->login->getInfoSegunRol( $id_usuario );

            $nombres = $data_rol['nombres'];
            $email = $data_rol['correo'];

            $this->enviarMail($email, $nombres, $codigo);

        }
        
        require_once("views/viewAutenticacion.phtml");
        
    }

    public function enviarMail( $email, $nombres, $codigo ){

/*Configuracion de variables para enviar el correo*/
        $mail_username="eucd12345@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword="Skyssar10";//Tu contraseña de gmail
        $mail_addAddress= $email;//correo electronico que recibira el mensaje
        $template="others/email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
        
        /*Inicio captura de datos enviados  para enviar el correo */
        $mail_setFromEmail= "eucd12345@gmail.com";
        $mail_setFromName= "Soporte Tecnico";
        $txt_message='Hola, '.$nombres.'. Al parecer estás queriendo acceder a la plataforma de lecturas.
        Tu código de verificación es '.'<b>' .$codigo. '.</b>';
        $mail_subject='Codigo de verificacion';
        
        $this->login->sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje

    }

}

  


?>
