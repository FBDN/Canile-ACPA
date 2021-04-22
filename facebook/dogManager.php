<?php
include "header3.php";
include "navigation.php";
?>
<div id="title">
<h1>Gestione Cani Smarriti</h1>
<h4 style="color:red">
<?php 
if(isset($_GET['msg'])){
	echo (string)$_GET['msg'];
	}
?></h4>
</div>
<div class="dogContainerWrapper" style="width:810px;margin:0px auto">
<ul id="doglist">
<?php
include 'config.php';

	$query = "SELECT * FROM cani";
	$res = mysql_query($query);
	while($perso = mysql_fetch_object($res)){
?>
	
    <li class="dogItem"><h3><?= $perso->nome ?></h3><div class="indirizzo"><h4>Perso in: <?= $perso->indirizzo?></h4></div><div class="action"><a href="deleteDog.php?idcane=<?= $perso->idCane?>">Elimina</a></div></li>
    
	
   <?php } ?>
</ul>
</div>
<div id="back"><h3><a href="index.php">Torna al Pannello</a></h3></div>
<?php
include "navigation_bottom.php";
?>
</body>
</html>