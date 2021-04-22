<?php
/*require_once('facebook/facebook.php');
$config = array(
    'appId' => '166072700200773',
    'secret' => '846675882d7fa4d4b5b46c74348896cf',
  );

  $facebook = new Facebook($config);*/
  ?>
<!doctype html>
<html>
<head>
<meta name="description" content="ACPA Canile Comunale di Cesena (Rio Eremo) Hai Perso il Cane? Chiama 0547 27730">
<meta name="keywords" content="Canile di Cesena, Associazione ACPA Cesena, Volontari Canile">
<link rel="stylesheet" type="text/css" href="css/stile.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<title>ACPA Canile Comunale di Cesena</title>
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
<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>

<script>
	FB.init({
	 appId  : '166072700200773',
	status : true, // check login status
	cookie : true, // enable cookies to allow the server to access the session
	xfbml  : true// parse XFBML
 });
FB.Canvas.setAutoGrow();
 <!--FB.Canvas.setSize({ width: 810, height: 1243 });-->

 </script>
<?php
/*$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');*/
?>
