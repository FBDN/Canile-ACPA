<?php
include "header.php";
?>
<meta property="og:title" content="A.C.P.A Canile Comunale di Cesena Foto degli Eventi">
<meta property="og:url" content="http://www.acpacesena.org/viewAlbum.php">
<meta property="og:image" content="http://www.acpacesena.org/img/LOGO.jpg">
<meta property="og:type" content="article">
<meta property="og:site_name" content="ACPACESENA.org">
<meta property="fb:page_id" content="348722635165449">
<?php
include "script.php";
?>
<title>ACPA Canile Comunale di Cesena - Foto degli Eventi -</title>
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
<h1>Foto dell'Evento</h1>
<!--<div id="loader"><img src="img/ajax-loader.gif" /><h3>Carico le Foto dall'Album su Facebook</h3></div>-->
</div>
<div class="dogContainerWrapper" style="width:860px;margin:0px auto">
<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '166072700200773',
    'secret' => '846675882d7fa4d4b5b46c74348896cf',
  );
  $facebook = new Facebook($config);
$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');
$idAlbum = (int)$_GET['idalbum'];
$query="/$idAlbum/photos?limit=400&offset=0";
$photos = $facebook->api($query);

//echo count($photos['data']);
foreach($photos['data'] as $photo)
{
	$photoId = explode("_",$photo['source']);
	$photo['images']['width'] = 206;
	$photo['images']['height'] = 206;
	$photo206= str_replace("/s720x720/","/p206x206/",$photo['source']);
		echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin:2px 3px 3px 2px;padding:0px;border:none\" title=\"\" href='".$photo['source']."'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background-image:url('".$photo206."');display:block;width:206px;height:206px;border:0px\"/></div></a><div class=\"user_like\" style=\"margin: -20px 0px 1px 2px;text-align: center;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;background:#2A49A5 url('img/like.png')left top no-repeat;padding: 3px 5px;box-shadow: 0 1px #4C6BC7 inset;border: 1px solid #082783;-moz-user-select: none;color: white;text-shadow: 0 -1px 0 #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href=\"http://www.facebook.com/photo.php?fbid=$photoId[1]&set=a.419597978077914.84383.348722635165449&type=3&permPage=1\" target=\"_blank\">D&iacute; che ti Piace questa Foto</a></p></div></div><div style=\"display:none\"><div id=\"storia_".$photo[id]."\"><p style=\"width:300px;height:auto;word-wrap:wrap\">".$photo['name']."</p></div></div>";
?>
<?php
}
?>
</div>
<script>
$(function(){
    $('.dogContainer a.dogDetail').lightBox();
	
	})
	
</script>
<?php
include "navigation_bottom.php";
?>

</body>
</html>