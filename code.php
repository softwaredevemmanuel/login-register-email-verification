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
            $mail->Subject = 'Email verification System';
            $mail_template = "
                <h2> You have registered with XYZ Company </h2>
                <h5> Verify Your email address to Login with the below given link</h5>
                <br/> <br/>
                <a href='http://localhost/login-register-email-verification/verify-email.php?token=$verify_token'>Click Here to Verify</a>

            ";
            $mail->Body =$mail_template;

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

      


        // Check if Email exists or Not
        $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_query_run = mysqli_query($con, $check_email_query);

        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $_SESSION['status'] = "Email Id already Exists";
            header("Location: register.php");
        }
        else{
            // Insert User / registered User data
         

            $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', '$email', '$password', '$verify_token')";
            $query_run = mysqli_query($con, $query);


            if($query_run){

                sendemail_verify("$name", "$email", "$verify_token");
                
                $_SESSION['status'] = "Registration Successfull. Please Verify your Email";
                header("Location: register.php");

            }else{
                $_SESSION['status'] = "Registration Failed";
                header("Location: register.php");
            }
        }
    }
?>