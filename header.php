<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '839107256130056',
    'secret' => 'adf14965a22948e2a42632730b63faee',
  );

  $facebook = new Facebook($config);
  ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
<meta name="description" content="ACPA Canile Comunale di Cesena (Rio Eremo) Hai Perso il Cane? Chiama 0547 27730">
<meta name="keywords" content="Canile di Cesena, Associazione ACPA Cesena, Volontari Canile">
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<div id="fb-root"></div>
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
  },
  "position":"bottom"
})});
</script>
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
