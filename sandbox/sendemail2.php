<?php

require_once("../photo_gallery/includes/PHPMailer/_lib/class.phpmailer.php");

$to_name = "Junk Mail";
$to = "mark_b@tuta.io";
$subject = "Mail Test at " . strftime("%T", time());
$message = "This is a test.";
$message = wordwrap($message,70);
$from_name = "Mark Bellingham";
$from = "mark@markbellingham.me";

// PHP SMTP version
$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host     = "your.host.com";
$mail->Port     = 25;
$mail->SMTPAuth = false;
$mail->Username = "your_username";
$mail->Password = "your_password";

$mail->FromName = $from_name;
$mail->From     = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject  = $subject;
$mail->Body     = $message;

$result = $mail->Send();
echo $result ? 'Sent' : 'Error';

?>
