<?php
session_start();


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rayan.cit.bd@gmail.com';                     //SMTP username
    $mail->Password   = 'lxzwqsemxofaawqt';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('rhrayan2228@gmail.com', 'Raju');     //Add a recipient

    // custom var$name = $_POST['name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "contact message form $name ";
    $mail->Body    = "
    <h1>$name</h1>
<h2>$email</h2>
<p>$message</p>
    ";

    $mail->send();
    echo 'Message has been sent';
    $_SESSION["sent"] = 'mail gese hurrah';
    header('location:../frontend/index.php#contact');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
