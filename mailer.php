<?php 
$to = "recipient@example.com";
$subject = "Your Reminder";
$message = "This is your reminder message.";
$headers = "From: test@example.com\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";


if(mail($to, $subject, $message, $headers)) {
    echo "mail sent";
}

?>
<!-- 
     --------------------
    |   CONFIGURATION   |
   ----------------------

smtp_server=smtp.gmail.com
smtp_port=587
error_logfile=error.log
debug_logfile=debug.log
auth_username=YourGmailId@gmail.com
auth_password=Your-Gmail-Password
force_sender=YourGmailId@gmail.com(optional) 
-->