<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * page d'acceuil
     *
     * @return void
     */
    public function indexAction()
    {
        if(isset($_POST['email'])){
                
            $mail = new PHPMailer();
            $mail->IsSMTP(); 
            $mail->Host        = "smtp.gmail.com"; 
            $mail->SMTPDebug   = 2; 
            $mail->SMTPAuth    = TRUE; 
            $mail->SMTPSecure  = "tls"; 
            $mail->Port        = 587; 
            $mail->Username    = 'MyGmail@gmail.com'; 
            $mail->Password    = 'MyGmailPassword';
            $mail->Priority    = 1; 
            $mail->CharSet     = 'UTF-8';
            $mail->Encoding    = '8bit';
            $mail->Subject     = 'Test Email Using Gmail';
            $mail->ContentType = 'text/html; charset=utf-8\r\n';
            $mail->From        = 'MyGmail@gmail.com';
            $mail->FromName    = 'GMail Test';
            $mail->WordWrap    = 900;

            //Recipients
            $mail->setFrom('alex.errecade@hotmail.com', 'ERRECADE');
            $mail->addAddress('alex.errecade@hotmail.com', $_POST['name']);

            //Content
            $mail->isHTML(true);                             
            $mail->Subject = 'Deamnde de renseignement ';
            $mail->Body    = $_POST['message'] .'and phone :  '. $_POST['phone'] . ' mail : '. $_POST['email'] ;

            $mail->send();

            if( $mail == true){
                $return = 
                " <script> alert('Demande envoyer avec succes');
                location.href = '/'  </script>";
                echo $return;
            }else{
                $return = 
                " <script> alert('Un problème est survenu lors de l'envoi du mail, veuillez nous excuser et ressayer ultérieurement.
                ');
                location.href = '/'  </script>";
                echo $return;
            }
        }
        echo $this->twig->render('home.html.twig');
    }
}
