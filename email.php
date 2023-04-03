<?php

$pagename = "Email";

require_once "header.php";


//Include Required Files - Need Autoloader
require_once 'PHPMailer/PHPMailerAutoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
//***** SPECIAL NOTE - DO NOT CHANGE FOR THIS CLASS *****
$mail->Username = 'midwayfireforms@gmail.com';  //'ccucsciweb@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'MailFireProject#20239';

//Set the encryption
$mail->SMTPSecure = 'ssl';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the subject line
//***** SPECIAL NOTE - OFTEN USES A VARIABLE INSTEAD WHEN FULLY IMPLEMENTING AND INCLUDING THIS PAGE *****
$mail->Subject = 'PHPMailer GMail SMTP test';

//Using HTML Email Body
$mail->isHTML(true);

//Set the Message Body
//***** SPECIAL NOTE - OFTEN USES A VARIABLE INSTEAD WHEN FULLY IMPLEMENTING AND INCLUDING THIS PAGE *****
$mail->Body = '<p style="color:purple">Hey, handy dandy PHPMailer here. Someone has accessed your webpage, just letting you know.</p>';

//Set who the message is to be sent from
$mail->setFrom('midwayfireforms@gmail.com', 'Midway Fire Forms - Sender');

//Set who the message is to be sent to
//Change
$mail->addAddress('midwayfireforms@gmail.com', 'Midway Fire Forms - Receiver');

//send the message, check for errors
if ($mail->send()) {
    echo 'Email worked!';
} else {
    echo 'Problems with email.';
}


require_once "footer.php";

?>





