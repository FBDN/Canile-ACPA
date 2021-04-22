<?php
$nome=$_POST['nome'];
$cognome = $_POST['cognome'];
$email=$_POST['email'];
$telefono = $_POST['telefono'];
$messaggio = $_POST['messaggio'];

///////////// receives the form values //////////////////////
$msgbody = "CONTATTO DAL SITO da:\n\n ".$nome."\n\n".$cognome."\n\nTelefono: ".$telefono."\n\n\n";
$msgbody .= $messaggio;
/////////////Allows the use of Apostrophes or single quotes /////////////////
$msgbody=stripslashes($msgbody);

/* subject */
$subject = "CONTATTO DAL SITO da ".$nome." ".$email;
   
$headers = "To: info@acpacesena.org\r\n";
$headers .= "From: $nome <$email>\r\n";
$parametri = "-f info@acpacesena.org";
/* and now mail it */
mail($to, $subject, $msgbody, $headers,$parametri);
echo "EMAIL INVIATA CON SUCCESSO RICEVERAI UNA RISPOSTA A BREVE";

?>