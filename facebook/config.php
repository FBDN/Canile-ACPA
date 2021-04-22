<?php
$host="sql.acpacesena.org";
$user="acpacese32677";
$pass="24111975";
$dbname="acpacese32677";
$link=mysql_connect($host,$user,$pass) or die("impossibile connettersi al database ricontrolla i dati ".mysql_error());
mysql_select_db($dbname,$link) or die("impossibile selezionare il database ".mysql_error());
?>