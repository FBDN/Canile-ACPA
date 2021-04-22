<?php
include "header.php";
?>
<meta property="og:title" content="A.C.P.A Canile Comunale di Cesena Cani Smarriti">
<meta property="og:url" content="http://www.acpacesena.org/canipersi.php">
<meta property="og:image" content="http://www.acpacesena.org/img/LOGO.jpg">
<meta property="og:type" content="article">
<meta property="og:site_name" content="ACPACESENA.org">
<meta property="fb:page_id" content="348722635165449">
<?php
include "script.php";
?>
<title>ACPA Canile Comunale di Cesena - Cani Smarriti -</title>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4246143-20', 'acpacesena.org');
  ga('send', 'pageview');

</script>
<?php
include "navigation.php";
?>
<div id="title">
<h1>Cani Smarriti</h1>
<h3><span style="color:red">Hai perso il Cane?</span> Chiama Subito il Canile allo 0547 27730 oppure 338 2065 977</h3>
<h3><span style="color:red">Inviaci Subito</span> una Foto del Tuo Cane a <a href="mailto://sos@acpacesena.org?subject=Ho Perso il Mio Cane">sos@acpacesena.org</a><br> con una descrizione della zona dove pensi si sia Perso.</h3>
<div id="loader"><img src="img/ajax-loader.gif" /><h3>Carico le Foto da Facebook</h3></div>
</div>
<div class="dogContainerWrapper">

</div>

<?php
include "navigation_bottom.php";
?>
<script>
$(function(){
	$('.dogContainerWrapper').load("photos4.php",function(){
		$("#loader").hide();
		});
	})
	
</script>
</body>
</html>