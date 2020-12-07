<?php
class modeloLogin{
    
    private $table;
    private $conectar;
    private $db;
 
    public function __construct($table){  
        $this->table = (string) $table;

        //require_once 'db/db.php';
        $this->conectar= new Conexion();
        $this->db= $this->conectar->connect();
    }

    public function validarLogin($usuario){

        $query = "SELECT * FROM $this->table WHERE username = '$usuario'";

        $consulta=$this->db->query($query);
        $result = mysqli_fetch_array($consulta);
            return $result;
            
    }

    public function insertarToken( $id_usuario, $token ){

        $query = "UPDATE $this->table SET token = '$token' WHERE id_usuario = $id_usuario";

        $consulta = $this->db->query($query);

        return $consulta;

    }

    
    public function getInfoUsuario( $id_usuario ){

        $query = "SELECT * FROM $this->table  WHERE id_usuario = '$id_usuario'";

        $consulta=$this->db->query($query);
        $result = mysqli_fetch_array($consulta);
            return $result;
            
    }

        
    public function getInfoSegunRol( $id_usuario ){

        $info = $this->getInfoUsuario( $id_usuario );
        if ( $info['id_rol']==1 ){
            $table_user = "profesores";
        }
        else{
            $table_user = "estudiantes";
        }

        $query = "SELECT * FROM $this->table u INNER JOIN $table_user t ON u.id_usuario = t.id_usuario
                 WHERE t.id_usuario = '$id_usuario'";

        $consulta=$this->db->query($query);
        $result = mysqli_fetch_array($consulta);
            return $result;
            
    }

    public function sendemail( $mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject, $template){
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
        $mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
        $mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
        $mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
        $mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
        $mail->Port = 587;                          // Puerto TCP  para conectarse 
        $mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
        $mail->addReplyTo("no-reply");//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
        $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
        $message = file_get_contents($template);
        $message = str_replace('{{first_name}}', $mail_setFromName, $message);
        $message = str_replace('{{message}}', $txt_message, $message);
        $message = str_replace('{{customer_email}}', $mail_addAddress, $message);
        $mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
        
        $mail->Subject = $mail_subject;
        $mail->msgHTML($message);
        if(!$mail->send()) {
            echo '<p style="color:red">No se pudo enviar el mensaje..';
            echo 'Error de correo: ' . $mail->ErrorInfo;
            echo "</p>";
        } 
    }

    



}
?>