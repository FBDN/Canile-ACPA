<?php
session_start();
if(!isset($_SESSION['admin'])){
	header('location:login.php');
}else{
include "header2.php";
include "navigation.php";
?>
<div id="title">
<h1>Amministrazione</h1>
<h3> Ciao <span style="color:red"><?= $_SESSION['admin']?></span></h3>
<div>
<h3><a href="dogFinder.php">Inserire Cani Smarriti</a></h3>
<h3><a href="dogManager.php">Gestione Cani Smarriti</a></h3>
<h3><a href="logout.php">Esci</a></h3>
</div>
</div>


<?php
include "navigation_bottom.php";
}
?>
</body>
</html>