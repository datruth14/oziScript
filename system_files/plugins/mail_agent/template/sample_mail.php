<?php
//call mail html template inside your app and configure based on your needs
//require('assets/plugins/mail_agent/template/sample_mail.php');

//calling mail agent sendMailTo() method inside your app just after you have called the mail html template....
//mail_agent($sender,$recipients,$subject,$mail_theme,$call_back);



//sender of the mail
//sender of the mail
//sender of the mail
$sender = "14Eter Limited";



//recipients, seperate by comma if want to send multiple recipients
//recipients, seperate by comma if want to send multiple recipients
//recipients, seperate by comma if want to send multiple recipients
$recipients = 
"
14eter@gmail.com,opiwsystem@gmail.com,helenajaramilo@gmail.com,datruth14.vd@gmail.com
";



//email subject will be here
//email subject will be here
//email subject will be here
$subject = "Testing Multiple Recievers";




//email html template here 
//email html template here 
//email html template here 
$mail_theme = 
"
This mail is intended to test multiple email sending. <br> 14Enterprise the brain of information communication technology Approved

"; //required






//callback after the mail has been sent. //its optional
//callback after the mail has been sent. //its optional
//callback after the mail has been sent. //its optional
$call_back = 
"
<script>
    alert('Mail Sent Successfully');
</script>
";

?>



