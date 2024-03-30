<?php
    require 'PHPmailer/src/Exception.php';
    require 'PHPmailer/src/PHPMailer.php';
    require 'PHPmailer/src/SMTP.php';
    //Load Composer's autoloader
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPmailer\PHPMailer\SMTP;
    use PHPmailer\PHPMailer\Exception;
function send_email($recipient, $subject, $content, $attachment){
    global $config;
    $email_config = $config['email'];
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $email_config['smtp_host'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $email_config['smtp_user'];                     //SMTP username
    $mail->Password   = $email_config['smtp_pass'];                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = $email_config['smtp_port'];                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom($email_config['smtp_user']);
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('sau.xanh.1803@gmail.com', 'Information');
    $mail->CharSet = 'UTF-8';
    try {
        $mail->addAddress($recipient);     //Add a recipient
        //Attachments
        if(!empty($attachment)){
            $mail->addAttachment($attachment);         //Add attachments
        }   
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
        return 'sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return 'unsent';
    }
}