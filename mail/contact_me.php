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
$to = $email_address; // put your email address here
$email_subject = "Complimentary Copy of With a Bot and a Prayer";
$email_message = "Dear $name \n\n".
				  "We thank you so very much for your interest in \"With a Bot and a Prayer: ".
              "Teaching and Learning in an Age of Generativity.\" Please find attached a ".
              "complimentary version of the book that you requested.\n\n".
              "We ask you to not share this file with others because we are finishing the".
              "Field Guide appendix and want to alert all readers when it is complete. If ".
              "you wish to share the book with others, please send them a link to ".
              "www.withabotandaprayer.com to request their own complimentary copy.\n\n".
              "We also invite you to connect with Jackson Nickerson via linked in.\n\n".
              "Happy reading,\n".
              "Mary Ellen Joyce and Jackson Nickerson";






$pdf_filename = 'TODO.pdf';
$path = 'books';
$pdf_file = $path . "/" . $pdf_filename;

$pdf_content = file_get_contents($pdf_file);
$pdf_content = chunk_split(base64_encode($pdf_content));

$epub_filename = 'TODO.epub';
$epub_file = $path . "/" . $epub_filename;

$epub_content = file_get_contents($epub_file);
$epub_content = chunk_split(base64_encode($epub_content));

$separator = md5(time());
$eol = "\r\n";
              
$headers = "From: noreply@withabotandaprayer.com" . $eol;
$headers .= "MIME-Version: 1.0" . $eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;

$email_body = "--" . $separator . $eol;
$email_body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
$email_body .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
$email_body .= $email_message . $eol;

if ($pdf == true) {
   $email_body .= "--" . $separator . $eol;
   $email_body .= "Content-Type: application/octet-stream; name=\"" . $pdf_filename . "\"" . $eol;
   $email_body .= "Content-Transfer-Encoding: base64" . $eol;

   $email_body .= "Content-Disposition: attachment; filename=\"" . $pdf_filename . "\"" . $eol . $eol;
   $email_body .= $pdf_content . $eol;
   $email_body .= "--" . $separator . "--";

   $email_body .= $eol;
}

if ($epub == true) {
   $email_body .= "--" . $separator . $eol;
   $email_body .= "Content-Type: application/octet-stream; name=\"" . $epub_filename . "\"" . $eol;
   $email_body .= "Content-Transfer-Encoding: base64" . $eol;

   $email_body .= "Content-Disposition: attachment; filename=\"" . $epub_filename . "\"" . $eol . $eol;
   $email_body .= $epub_content . $eol;
   $email_body .= "--" . $separator . "--";
}


mail($to,$email_subject,$email_body,$headers);


// send address to withabotandaprayer email

$us_to = "withabotandaprayer@gmail.com";
$us_subject = "New complimentary copy requested! ";

if($pdf == true) {
   $us_subject .= "PDF";
}
if($pdf == true && $epub == true){
   $us_subject .= " and ";
}
if($epub == true){
   $us_subject .= "EPUB";
}

mail($us_to, $us_subject, "email: $email_address, name: $name", "From: noreply@withabotandaprayer.com");

return true;			
?>
