<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

Class Email {

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '1c66bb673608e7';
        $mail->Password = 'd0d1bd898469a1';

        $mail->setFrom('admin@centalpizza.com');
        $mail->addAddress('admin@centralpizza.com', 'CentralPizza.com');
        $mail->Subject = 'Confirma tu cuenta.';

         //Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en CentralPizza.com, solo 
         debes confirmarla presionando el siguiente enlace.</p>";
         $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirm-account?token="
         . $this->token . "'>Confirmar cuenta</a> </p>";
         $contenido .= "<p>Si tú no solicitaste esta cuenta, ignora el mensaje.</p>";
         $contenido .= "</html>";
         $mail->Body = $contenido;
 
         //Enviar Email
         if($mail->send()){
            echo 'Mensaje enviado correctamente.';
         }else{
            echo 'El mensaje no se pudo enviar';
         }
       
    }

    public function enviarEmailRecuperacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '1c66bb673608e7';
        $mail->Password = 'd0d1bd898469a1';

        $mail->setFrom('admin@centalpizza.com');
        $mail->addAddress('admin@centralpizza.com', 'CentralPizza.com');
        $mail->Subject = 'Restablecer password de tu cuenta.';

         //Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado re-establecer el password 
         de tu cuenta en CentralPizza.com, usa el enlace adjunto para hacer el cambio.</p>";
         $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/retrieve?token="
         . $this->token . "'>Restablecer password</a> </p>";
         $contenido .= "<p>Si tú no solicitaste este cambio en tu cuenta, ignora el mensaje.</p>";
         $contenido .= "</html>";
         $mail->Body = $contenido;
 
         //Enviar Email
         if($mail->send()){
            echo 'Mensaje enviado correctamente.';
         }else{
            echo 'El mensaje no se pudo enviar';
         }

    }

}