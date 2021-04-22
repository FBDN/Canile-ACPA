<?php
include "header.php";
include "navigation.php";
?>
<div id="tweets"></div>
<div id="title">
<h1>Le Adozioni</h1>
<div id="loader" style="text-align:center"><img src="img/ajax-loader.gif" /><h3>Carico le Foto da Facebook</h3></div>
</div>

<div class="dogContainerWrapper" style="width:860px;margin:0px auto">

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