<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '166072700200773',
    'secret' => '846675882d7fa4d4b5b46c74348896cf',
  );

  $facebook = new Facebook($config);
  ?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stile.css">
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<!--<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>-->
<script src="js/jquery.lightbox-0.5.min.js"></script>
<title>ACPA Canile Comunale di Cesena</title>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000000",
      "text": "#ffffff"
    },
    "button": {
      "background": "#F4D82F"
    }
  },
  "content": {
    "message": "A.C.P.A CESENA  usa i Cookies per migliorare la Tua Esperienza sul Sito",
    "dismiss": "Ok, Ho Capito",
    "link":"Leggi Tutto",
    "href": "http://www.acpacesena.org/privacy.php"
  }
})});
</script>
</head>
<body>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1&appId=166072700200773";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');
?>
<div class="rubberBand" style="background:url('img/band.jpg') repeat-x left top;margin:0px;padding:0px;width:100%;height:50px;position:fixed;margin-top:-50px;z-index:999999">
<div class="menuContainer" style="width:951px;margin:0px auto">
<ul class="menu-bar sixteen columns">
		<li class="menu-item" ><a href="index.htm" class="home selected">HOME</a></li>
		<li class="menu-item"><a href="#" class="chisiamo">CHI SIAMO</a></li>
		<li class="menu-item" ><a href="#" class="attivita">ATTIVITA'</a></li>
		<li class="menu-item" ><a href="#" class="volontario">DIVENTA VOLONTARIO</a></li>
		<li class="menu-item" ><a href="#" class="consigli">CONSIGLI UTILI</a></li>
		<li class="menu-item" ><a href="dovesiamo.php" class="dove">DOVE SIAMO</a></li>
		</ul>
	</div>
</div>
<div class="container" style="width:951px;margin:0px auto;background-color:white">
<div class="header" style="width:951px;margin:0px auto;text-align:center;margin-bottom:100px;margin-top:50px">
<img src="img/testata.jpg">
</div>
<div class="header2" style="width:951px;margin:0px auto;text-align:center;margin-bottom:50px">
<img src="img/main_menu.jpg">
</div>
<div id="title">
<h1>Le Adozioni</h1>
</div>
<div class="dogContainerWrapper" style="width:850px;margin:0px auto">
<?php
$photos = $facebook->api("/419597978077914/photos?limit=400&offset=0");
//echo count($photos['data']);
foreach($photos['data'] as $photo)
{
	$photoId = explode("_",$photo['source']);
	$photo['images']['width'] = 206;
	$photo['images']['height'] = 206;
	$photo206= str_replace("/s720x720/","/p206x206/",$photo['source']);
		echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin:2px 3px 3px 2px;padding:0px;border:none\" title=\"\" href='".$photo['source']."'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background-image:url('".$photo206."');display:block;width:206px;height:206px\"/></div></a><div class=\"user_like\" style=\"
    margin: -20px 0px 1px 2px;
    text-align: center;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;background:#2A49A5 url('img/like.png')left top no-repeat;padding: 3px 5px;box-shadow: 0 1px #4C6BC7 inset;border: 1px solid #082783;-moz-user-select: none;color: white;text-shadow: 0 -1px 0 #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href=\"http://www.facebook.com/photo.php?fbid=$photoId[1]&set=a.487813207923057.84377.348722635165449&type=3&permPage=1\" target=\"_blank\">Di che ti Piace questa Foto</a></p></div></div>";
}
?>
</div>
</div>
<div class="rubberBand" style="background:url('img/band.jpg') repeat-x left top;margin:0px;padding:0px;width:100%;height:50px">
<div class="menuContainer" style="width:951px;margin:0px auto">
<ul class="menu-bar sixteen columns">
		<li class="menu-item" ><a href="index.htm" class="home selected ">HOME</a></li>
		<li class="menu-item"><a href="#" class="chisiamo">CHI SIAMO</a></li>
		<li class="menu-item" ><a href="#" class="attivita">ATTIVITA'</a></li>
		<li class="menu-item" ><a href="#" class="volontario">DIVENTA VOLONTARIO</a></li>
		<li class="menu-item" ><a href="#" class="consigli">CONSIGLI UTILI</a></li>
		<li class="menu-item" ><a href="dovesiamo.php" class="dove">DOVE SIAMO</a></li>
		</ul>
	</div>
</div>
<script>
$(function(){
	$('a.dogDetail').on("mouseover",function(){
		$(this).append('<div class="arrow" style="position:absolute;top:0px;left:80px;z-index:9999"><img src="img/arrow.png"></div>');
		});
		$('a.dogDetail').on("mouseout",function(){
		$(this).find('.arrow').remove();
		});
    $('.dogContainer a.dogDetail').lightBox();
	})
</script>
</body>
</html>