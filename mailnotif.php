<?php
require_once("config.php");
require_once("functions.php");
// $volunteer
// Getting volunteer infos

if(isset($_GET['volunteer'])){
    $body = PrepareEmail('volunteer');    
}elseif(isset($_GET['anniv'])){
    $body = PrepareEmail('anniv');     
}

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
//le canal
$mail->Username = "compteGmail";
//Password to use for SMTP authentication
$mail->Password = "MotDePasseDuCompte";
//Set who the message is to be sent from
$mail->setFrom('compteGmail', 'Nom DuCompte');
//Set an alternative reply-to address
$mail->addReplyTo('compteGmail', 'Nom duCompte');
//Set who the message is to be sent to
// $mail->addAddress('sagnakhadi93@gmail.com', 'SAGNA Khadi');
$mail->addAddress('dramane.coulibaly@unv.org', 'Dramane');
// Enable HTML email
$mail->IsHTML(true); 
//Set the subject line
$mail->Subject = 'UNV ALERT';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('activation.php'), "C:\wamp64\www\ALERTUNV\emails");
//Replace the plain text body with one created manually
$mail->Body = $body;
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
// exit("Success!");
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
exit("<br>volunteer!");
    header_remove();
    header("Location: afficherinfo.php?id=$id");
    exit;
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}