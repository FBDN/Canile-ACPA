<?php
include "config.php";
$query = "DELETE FROM cani 	WHERE idCane = ".(int)$_GET['idcane']."";
mysql_query($query);
header('location:dogManager.php?msg=Cane Eliminato con Successo');
?>