<?php
require("LinkToSQL.php");
$title=$_POST["title"];
$SQLTable="SELECT * FROM email";
$message=$_POST["message"];
$message=nl2br($message);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if($title!=null){
    $result=mysqli_query($LinkToSQL,$SQLTable);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
           $email=$row["userEmail"];
           try {
            //Server settings
            $mail->SMTPDebug = 2;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'a1083365@mail.nuk.edu.tw';             //SMTP username
            $mail->Password   = 'aas19894';                             //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPSecure ="ssl";
            $mail->CharSet ="UTF-8";
            //Recipients
            $mail->setFrom('a1083365@mail.nuk.edu.tw', '每月電報');
            $mail->addAddress($email, '訂閱者');     //Add a recipient
            $mail->isHTML(true);                     //Set email format to HTML
            $mail->Subject = $title;
            $message ="您好, 你傳送的訊息:<br>".$message."<br><br>我們會在三天內回覆";
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';//如果不是用Html
        
            $mail->send();
            echo '訊息已送出';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        }
    }
}


?>