<?php
include 'config.php';
$nome = mysql_real_escape_string($_POST['nome']);
$taglia = mysql_real_escape_string($_POST['taglia']);
$indirizzo = mysql_real_escape_string($_POST['indirizzo']);
$query = "INSERT INTO cani (idCane,nome,taglia,indirizzo) VALUES('','".$nome."','".$taglia."','".$indirizzo."')";
mysql_query($query) or die('Errore inserimento Cane '+mysql_error());
echo "Cane Inserito con Successo";
?>
