<?php
session_start();
if(!isset($_SESSION['admin'])){
	header('location: login.php');
}else{
include "header.php";
include "navigation.php";
?>
<div id="title">
<h1>Amministrazione Cani Smarriti</h1>
<div>
    <form id="cani_form" name="cani_form">
    Come si chiama il cane?<input id="nome" type="text" value=""><br>
    Taglia del cane?<select id="combo" name="cb_taglia"><option value="piccola">Piccola</option><option value="media">Media</option><option value="grande">Grande</option></select><br>
    Dove &egrave; stato perso il cane?<input id="via" type="text" value="Inserire Via, numero civico, citt&agrave;, etc"><br><input type="button" value="posiziona sulla mappa" onclick="codeAddress()">
	</form>
    <div id="result_form" style="color:red;text-transform:uppercase"></div>
    </div>
</div>
<div class="dogContainerWrapper" id="map_canvas" style="width:810px;height:600px;margin:0px auto">

</div>
<div id="back"><h3><a href="index.php">Torna al Pannello</a></h3></div>
<?php
include "navigation_bottom.php";
}
?>
</body>
</html>