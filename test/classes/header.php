<?php
require_once './vendor/autoload.php';
use Fbdn\Utilities\Utility;
$db = new Utility();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>A.C.P.A Canile Comunale di Cesena</title>

<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
	integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
	crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="img/icone/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/icone/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/icone/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/icone/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/icone/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/icone/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/icone/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/icone/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/icone/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/icone/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/icone/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/icone/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/icone/favicon-16x16.png">
<link rel="manifest" href="img/icone/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="img/icone/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
    <script type="text/javascript">
  (function() {
	var c = 'js/acpa.js';
    var a = document.createElement('script'); a.type = 'text/javascript'; a.async = true;
    a.src = ('https:' == document.location.protocol ? 'https://www' : 'http://www') + '.acpacesena.org/test/'+c;
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(a, s);
   })();
</script>
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
    "message": "A.C.P.A CESENA  usa i Cookies per migliorare la Tua Esperienza sul Suo Sito",
    "dismiss": "Ok, Ho Capito",
    "link":"Leggi Tutto",
    "href": "http://www.acpacesena.org/test/privacy.php"
  }
})});
</script>
</head>
<body class="bg-light">
	<div class="container main">
		<div class="row header">

			<div class="logo col-md-12 col-xs-12 d-none d-lg-block">
				<h3 class="title "><a href="index.php"><img src="img/logo.png"/></a>Associazione Cesenate Protezione Animali</h3>
				
			</div>
		</div>
		<div class="navigation container">
		<div class="row">
		<div class="col-md-12 mx-0 text-center">
			<nav class="navbar navbar-expand-lg">
			<a class="navbar-brand d-block d-sm-block d-xs-block d-md-none d-lg-none d-xl-none" href="index.php">
    <img src="img/icone/android-icon-36x36.png" class="d-inline-block align-top" alt="">
  </a>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
					aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<li class="nav-item"><a href="index.php"
							class="nav-link home">HOME</a></li>
							<!-- <li class="dropdown">
          <a href="#" class="nav-link gallery dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Galleria<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link chisiamo album" href="showAlbum.php?album=419597978077914">Le Nostre Adozioni</a></li>
            <li><a class="nav-link dove album" href="showAlbum.php?album=594092297295147">I Nostri Ospiti</a></li>
            <li><a class="nav-link attivita" href="#" >Hai Perso il Cane?</a></li>
            <li role="separator" class="divider"></li>
            <li><a class="nav-link volontario" href="showAlbum.php?album=487813207923057">Storie a Lieto Fine</a></li>
            <li role="separator" class="divider"></li>
            <li><a class="nav-link consigli" href="#">Vuoi Adottare un Cane Adulto?</a></li>
          </ul>
        </li> -->
						<li class="nav-item"><a href="eventi.php"
							class="nav-link eventi">EVENTI</a></li>
						<li class="nav-item"><a href="gatti.php" class="nav-link dove">CERCO CASA</a>
						</li>
						<li class="nav-item"><a href="donazione.php"
							class="nav-link attivita">DONAZIONI</a></li>
						<li><a href="volontario.php" class="nav-link volontario">DIVENTA
								VOLONTARIO</a></li>
						<li><a href="consigli-utili.php" class="nav-link consigli">CONSIGLI
								UTILI</a></li>
						<li><a href="volontario.php" class="nav-link dove">TRASPARENZA</a></li>
						<li><a href="contatti.php" class="nav-link chisiamo">CONTATTI</a></li>
					</ul>
				</div>
			</nav>
			</div>
			</div>
		</div>
		<hr>
		<div class="row">
		<div class="col-md-12 p-5">
		<div id="tweets" class="border-left border-primary">
		</div>
		</div>
		</div>
		<hr>
		<div class="row text-center">
		<div class="col-md-3"><a href="showAlbum.php?album=594092297295147"><img src="img/images/acpa_cani_trovati.png"></a></div>
		<div class="col-md-3"><a href="showAlbum.php?album=557893727581671"><img src="img/images/acpa_cani_persi.png"></a></div>
		<div class="col-md-3"><a href="storie.php"><img src="img/images/acpa_storie_lieto_fine.png"></a></div>
		<div class="col-md-3"><a href="#"><img src="img/images/acpa_cane_adulto.png"></a></div>
		</div>