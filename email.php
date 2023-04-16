<?php

$pagename = "Email";

require_once "header.php";

/*
/**
 * PHP Mailer Base - Created by Cloudways
 *
 * This is a base library addition for using the PHPMailer, created by Cloudways for use with the PHPMailer system
 * when imported into the project. This base was then adjusted for use.
 * USED IN TESTING TO ENSURE THAT THE EMAIL ACTUALLY SENDS, NOT CLAIMED AS OWN AND IS NOT FINAL.


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
// code to send email


    // Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ccucsciweb@gmail.com';                     // SMTP username
    $mail->Password   = 'csci303&409';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('midwayfireforms@gmail.com', 'Recipient');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    echo 'Message has been sent';
 */


$to = "midwayfireforms@gmail.com"; //change this to the variable of the recipient
$subject = "Midway Fire and Rescue - Database Updated";

$message = "
<html>
<head>
<title>Your Database Information has been Updated.</title>
</head>
<body>
<p>Your information has been inserted into the database. Here is an email for that:</p>
<table style='border:1px solid black; padding:10px; border-collapse: collapse;'>
<tr>
<th style='border:1px solid black; padding:5px;'><b><i>Table Info</i></b></th>
<th style='border:1px solid black; padding:5px;'><b><i>Table Data</i></b></th>
</tr>
<tr>
<td style='border:1px solid black; padding:5px;'>AddressHere</td>
<td style='border:1px solid black; padding:5px;'>YesNoHere</td>
</tr>
</table>
<p>Thank you for your cooperation.<br>- Midway Fire and Rescue</p>
</body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <midwayfireforms@gmail.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to, $subject, $message, $headers);
?>

<p>
    Wow, we just sent an email to [midwayfireforms@gmail.com], isn't that just nifty?
    Hopefully it's not marked as Spam this time!
</p>


<?php


require_once "footer.php";

?>





