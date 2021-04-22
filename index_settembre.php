<?php
include "header.php";
?>
<meta property="og:title" content="A.C.P.A Canile Comunale di Cesena Le Adozioni">
<meta property="og:url" content="http://www.acpacesena.org/index.php">
<meta property="og:image" content="http://www.acpacesena.org/img/LOGO.jpg">
<meta property="og:type" content="article">
<meta property="og:site_name" content="ACPACESENA.org">
<meta property="fb:page_id" content="348722635165449">
<?php
include "script.php";
?>
<title>ACPA Canile Comunale di Cesena - Le Adozioni -</title>

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
<div id="tweets"></div>
<div id="title">
<h1>Le Adozioni</h1>
<div id="loader"><img src="img/ajax-loader.gif" /><h3>Carico le Foto da Facebook</h3></div>
</div>

<div class="dogContainerWrapper">

</div>

<?php
include "navigation_bottom.php";
?>

<script>
$(document).ready(function(){
	$('.dogContainerWrapper').load("photos.php",function(){
		$("#loader").hide();
		$("#tweets").twitterFeed();
		});
})
	
</script>
<!--<script>
$(function()
{
   var ticker = function()
   {
      setTimeout(function(){
         $('#tweets-wrapper li:first').animate( {marginTop: '-120px'}, 800, function()
         {
            $(this).detach().appendTo('ul#tweets-wrapper').removeAttr('style');
         });
         ticker();
      }, 4000);
   };
   ticker();
});

</script>-->
</body>
</html>