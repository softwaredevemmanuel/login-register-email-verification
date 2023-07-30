<?php
    session_start();
    include('dbcon.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    
    function sendemail_verify($name, $email, $verify_token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'eokereke47@gmail.com';                     //SMTP username
            $mail->Password   = 'ldrauosrxjtapotk';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('eokereke47@gmail.com', 'Mailer');
            $mail->addAddress($email,$name);
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Welecom To My Website';
            $mail->Body    = '<p> This is the Verifecation Link<b><a href="http://localhost/coursephp/P1/Sliding/?Verification=">"http://localhost/coursephp/P1/Sliding/?Verification="</a></b></p>';

            $mail->send();
            echo 'Message has been sent';

        } catch (Exception $e) {
            echo "Message could not be sent.";
        }

    }

    if(isset($_POST['register_btn'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $verify_token = md5(rand());

        sendemail_verify("$name", "$email", "$verify_token");
        echo "Sent";
    }
?>