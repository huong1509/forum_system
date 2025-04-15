<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();
$title = 'Contact Us';

session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = 'You need to login to contact us!';
    header('Location: ../controllers/auth/signin-code.php');
    exit(0);
}

ob_start();
    if(isset($_POST['message'])){

        $subject = $_POST['subject'];
        $message = $_POST['message'];

        if(empty(trim($subject)) || empty(trim($message)))
            $_SESSION['status'] = 'All fields are mandetory';
        else{
            try {
    
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
    
                $mail->Username = 'huongnsgch230101@fpt.edu.vn';
                $mail->Password = 'apmexvqtgjqjhxxs'; 
    
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port = 587; 
                
                $mail->setFrom('huongnsgch230101@fpt.edu.vn', 'Klein Nguyen');
                $mail->addAddress('nguyenhuong150905@gmail.com', 'Huong Nguyen');
    
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
    
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                $mail->isHTML(true);
                $mail->Subject = ''.$subject.''; 
                $mail->Body = ''.$message.''; 
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                $mail->send(); 
    
                $_SESSION['status'] = 'Your message sent successful!';
    
            } catch (Exception $e) { 
                // $output = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } 
    
include '../templates/contact.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';
?>