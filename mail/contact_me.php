<?php
// check if fields passed are empty
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['pdf'])	      ||
   empty($_POST['epub'])	   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$pdf = $_POST['pdf'];
$epub = $_POST['epub'];


	
// send book to customer	
$to = 'gennickerson@gmail.com'; // put your email address here
$email_subject = "Contact form submitted by:  $name";
$email_body = "You have received a new message. \n\n".
				  " Here are the details:\n \nName: $name \n ".
				  "Email: $email_address\n pdf: \n $pdf\n epub: \n $epub";
$headers = "From: noreply@withabotandaprayer.com\n"; 
// Since this email form will be generated from your server. The From email address will be best using something like this noreply@yourdomain.com
$headers .= "Reply-To: $email_address";	


// $pdffile = "";
// $epubfile ="";

// if ($pdf == true) {

// }

// if ($epub == true) {

// }
mail($to,$email_subject,$email_body,$headers);


// send address to withabotandaprayer email

return true;			
?>
