<?php

require_once "connect.php";

$query = "SELECT email FROM klanten ORDER BY id DESC LIMIT 1";

$result = mysqli_query($db, $query);

$email = mysqli_fetch_assoc($result);

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'C:\xampp\composer\vendor\autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                // Enable verbose debug output
    $mail->isSMTP();                                     // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                            // Enable SMTP authentication
    $mail->Username   = 'cjpnabbe@gmail.com';       // SMTP username
    $mail->Password   = 'Paperjetpoet1292';                  // SMTP password
    $mail->SMTPSecure = 'tls';                           // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                     // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cjpnabbe@gmail.com', 'Carli Nabbe');
    $mail->addAddress($email['email']);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Uw reservering';
    $mail->Body    = 'Uw reservering is bevestigd bij de Posterij!';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';

    // header("Location: index.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>