<?php
if(!isset($_POST['submit']))
{
    //This page should not be accessed directly. Need to submit the form.
    echo "Error: You need to submit the form!";
}
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//Validate name and email
if(empty($name)||empty($visitor_email))
{
    echo "Please add your name and email to the appropriate fields.";
    exit;
}
$email_from = 'hello@amanovans.com';
$email_subject = "New Form submission: $subject";
$email_body = "You have received a new message from $name.\n".
              "Here is the message:\n $message".

$to = "hello@amanovans.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";

function IsInjected($str)
{
    $injections = array('(\n+)',
           '(\r+)',
           '(\t+)',
           '(%0A+)',
           '(%0D+)',
           '(%08+)',
           '(%09+)'
           );
               
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    
    if(preg_match($inject,$str))
    {
      return true;
    }
    else
    {
      return false;
    }
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

mail($to,$email_subject,$email_body,$headers);
?>