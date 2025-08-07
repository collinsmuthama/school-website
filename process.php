<?php

header('Content-Type: ');

// Include PHPMailer classes
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



//check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    //get the submitted data

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if(empty($name) || empty($email) || empty($message)) {
        echo json_encode(['message' => 'All fields are required.']);
        http_response_code(400);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['message' => 'Invalid email address.']);
        http_response_code(400);
        exit;
    }

    // Prepare email
    $mail  =  new PHPMailer(true);

    try {
        //SMTP set up
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username  = 'mmuthamacollins90@gmail.com';
        $mail->Password = 'vwhv azvq jevk ygux';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //mail content
        $mail->setFrom($email,$name);
        $mail->addAddress($mail->Username);
        $mail->Subject = 'Inquiry';
        $mail->Body = $message;
        $mail->send();
        echo json_encode(['message' => 'Your message has been sent successfully!']);
        return;


    } catch (Exception $e) {
         echo json_encode(['message' => 'Failed to send your message.'.$mail->ErrorInfo]);
         return;
    }

}
else {
     echo json_encode(['message' => 'Failed to send your message.']);
     return;
}

?>