<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '166072700200773',
    'secret' => '846675882d7fa4d4b5b46c74348896cf',
  );
	$albumid = array("457786657592379","435999073104471","551286541575723","535616029809441");
  $facebook = new Facebook($config);
$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');
foreach($albumid as $idAlbum){
$photo = $facebook->api("/".$idAlbum."?fields=photos.fields(source),name","get");
//echo "<pre>".print_r($photo)."</pre>";
//print_r($photo['picture']);
//echo count($photos['data']);
	/*$photoId = explode("_",$photo['source']);
	$photo['images']['width'] = 206;
	$photo['images']['height'] = 206;*/
	//$photo206= str_replace("/s720x720/","/p206x206/",$photo['photos']['data'][0]['source']);
		echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin: 10px auto 60px auto;padding:15px;border:none\" title=\"\" href='http://www.acpacesena.org/viewAlbum.php?idalbum=$idAlbum'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background:url('".$photo['photos']['data'][0]['source']."') top left no-repeat;display:block;width:180px;height:135px\"/></div></a><div class=\"AlbumName\" style=\"margin: -20px 0px 1px 2px;position:absolute;text-align: center;top: 170px;left: -15px;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;padding: 3px 5px;color: #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href='http://www.acpacesena.org/viewAlbum.php?idalbum=$idAlbum'>".$photo['name']."</a></p></div></div><div style=\"display:none\"></div>";
?>
<?php
}
?>