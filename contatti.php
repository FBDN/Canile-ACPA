<?php
include "header_norm.php";
?>
<meta property="og:title" content="A.C.P.A Canile Comunale di Cesena Contattaci">
<meta property="og:url" content="http://www.acpacesena.org/contatti.php">
<meta property="og:image" content="http://www.acpacesena.org/img/LOGO.jpg">
<meta property="og:type" content="article">
<meta property="og:site_name" content="ACPACESENA.org">
<meta property="fb:page_id" content="348722635165449">
<title>ACPA Canile Comunale di Cesena Contattaci</title>
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
<h1>Contatti</h1>
<h3>Via Cesuola Rio Eremo, 1351 Cesena</h3>
<h2 style="color:blue">Orari di Apertura</h2>
<h3>Primavera - Estate: giorni feriali   14.30 - 18.30</h3>
<h3>Autunno - Inverno: giorni feriali    12:30 - 16:30</h3>
<h2 style="color:blue">Recapiti Telefonici</h2>
<h3>Giorni feriali (08.00 - 20.00) 0547 27730 oppure 338 2065 977</h3>
<h3>Domeniche e giorni festivi (08.00 - 20.00) 338 2065 977</h3>
<h3>Notturno (20.00 - 08.00) In caso di urgenza chiamare le forze dell'ordine 112 o 113 le quali si metteranno in contatto con noi.</h3>
</div>
<div class="dogContainerWrapper" style="width:860px;margin:0px auto">
<div class="left" id="map">
<iframe width="400" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=Rio+Eremo,+47521+Cesuola-rio+Dell'eremo,+Provincia+di+Forl%C3%AC-Cesena,+Emilia-Romagna&amp;layer=c&amp;sll=44.114090,12.238309&amp;cbp=13,146.17,,0,3.05&amp;cbll=44.09503,12.233526&amp;hl=it&amp;ie=UTF8&amp;hq=Rio+Eremo,&amp;hnear=Cesuola-rio+Dell'eremo,+Forl%C3%AC-Cesena,+Emilia-Romagna&amp;t=h&amp;panoid=fITUZUUvwhMS0DJUYYqqLg&amp;source=embed&amp;ll=44.093257,12.233534&amp;spn=0.006164,0.008583&amp;z=16&amp;output=svembed"></iframe><br /><small><a href="https://maps.google.it/maps?q=Rio+Eremo,+47521+Cesuola-rio+Dell'eremo,+Provincia+di+Forl%C3%AC-Cesena,+Emilia-Romagna&amp;layer=c&amp;sll=44.114090,12.238309&amp;cbp=13,146.17,,0,3.05&amp;cbll=44.09503,12.233526&amp;hl=it&amp;ie=UTF8&amp;hq=Rio+Eremo,&amp;hnear=Cesuola-rio+Dell'eremo,+Forl%C3%AC-Cesena,+Emilia-Romagna&amp;t=h&amp;panoid=fITUZUUvwhMS0DJUYYqqLg&amp;source=embed&amp;ll=44.093257,12.233534&amp;spn=0.006164,0.008583&amp;z=16" style="color:#0000FF;text-align:left">Visualizzazione ingrandita della mappa</a></small>
</div>
<div class="right" id="form">
<form id="contatti">
				<div>
					<p class="left"><label for="nome">Nome *</label><input type="text" id="nome" class="input_text" /></p>
					<p class="right"><label for="cognome">Cognome *</label><input type="text" id="cognome" class="input_text" /></p>
				</div>
				<div>
					<p class="left"><label for="telefono">Telefono *</label><input type="text" id="telefono" class="input_text" /></p>
					<p class="right"><label for="email">E-mail *</label><input type="text" id="email" class="input_text" /></p>
				</div>
				<div>
					<label for="messaggio">Messaggio</label><textarea cols="" rows="" id="messaggio"></textarea>
				</div>
				<span class="separator"></span>
				<i>* campo obbligatorio contrassegnato</i>
				<p>
					<input type="checkbox" value="" class="input_checkbox" />Acconsento al trattamento dei dati personali trasmessi secondo il D.Lgs 196/2003
				</p>
				<div>
					<input type="submit" class="input_invia_richiesta" />
				</div>
			</form>
            <div id="response" style="color:red"></div>
</div>
</div>
<script type="text/javascript">
$(function(){
	$('.input_invia_richiesta').click(function(e){
		e.preventDefault();
		$.ajax({
			type:'post',
			url:'mailSito.php',
			data:'nome='+$('#nome').val()+'&cognome='+$('#cognome').val()+'&email='+$('#email').val()+'&telefono='+$('#telefono').val()+'&messaggio='+$('#messaggio').val(),
			success:function(data){
				$('#response').html(data);
				}
			});
		});
});
</script>
<?php
include "navigation_bottom.php";
?>
</body>
</html>