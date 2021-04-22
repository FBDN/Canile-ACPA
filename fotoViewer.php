<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '166072700200773',
    'secret' => '846675882d7fa4d4b5b46c74348896cf',
  );
  $facebook = new Facebook($config);
$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');
$idAlbum = (string)$_GET['idalbum'];
echo $idAlbum;
$query="/$idAlbum/photos?limit=400&offset=0";
echo $query;
$photos = $facebook->api($query);

//echo count($photos['data']);
foreach($photos['data'] as $photo)
{
	$photoId = explode("_",$photo['source']);
	$photo['images']['width'] = 206;
	$photo['images']['height'] = 206;
	$photo206= str_replace("/s720x720/","/p206x206/",$photo['source']);
		echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin:2px 3px 3px 2px;padding:0px;border:none\" title=\"\" href='".$photo['source']."'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background-image:url('".$photo206."');display:block;width:206px;height:206px\"/></div></a><div class=\"user_like\" style=\"margin: -20px 0px 1px 2px;text-align: center;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;background:#2A49A5 url('img/like.png')left top no-repeat;padding: 3px 5px;box-shadow: 0 1px #4C6BC7 inset;border: 1px solid #082783;-moz-user-select: none;color: white;text-shadow: 0 -1px 0 #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href=\"http://www.facebook.com/photo.php?fbid=$photoId[1]&set=a.419597978077914.84383.348722635165449&type=3&permPage=1\" target=\"_blank\">D&iacute; che ti Piace questa Foto</a></p></div></div><div style=\"display:none\"><div id=\"storia_".$photo[id]."\"><p style=\"width:300px;height:auto;word-wrap:wrap\">".$photo['name']."</p></div></div>";
?>
<?php
}
?>
<script>
$(function(){
    $('.dogContainer a.dogDetail').lightBox();
	
	})
	
</script>