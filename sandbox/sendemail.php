<?php

$to = "mark_b@tuta.io";

// Windows may not handle this format well
// $to = "Mark Bellingham <mark_b@tuta.io>";

// multiple recipients
// $to = "junkmail@example.com, morejunk@example.com";
// $to = "Mark Bellingham <junkmail@example.com>, morejunk@example.com";

$subject = "Mail Test at " . strftime("%T", time());

$message = "This is a test.";
// Optional: Wrap linkes for old email programs
// wrap at 70/72/75/78
$message = wordwrap($message,70);

$from = "mark@markbellingham.me";
$headers = "From: {$from}";

$result = mail($to, $subject, $message, $headers);
echo $result ? 'Sent' : 'Error';

?>
