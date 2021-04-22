<?php
require_once('facebook/facebook.php');
$config = array(
    'appId' => '839107256130056',
    'secret' => 'adf14965a22948e2a42632730b63faee',
  );

  $facebook = new Facebook($config);
$user_profile = $facebook->api('/acpa.cesena');
$albums = $facebook->api('/acpa.cesena/albums');
$photos = $facebook->api("/419597978077914/photos?fields=images&access_token=EAAL7KeHuGggBANhEuNclBYcyZBPIwZCencHcqvckpc8uULcvOUcgJMgzPyd7szEiONBQrUslQnBwZBp5udZBqHeDfEzM60hmHPce7wnEoolL1HryhN7SZBJEHo7XyjPYZBsWXJPvkzuxxP0IyLrXAMOUXKTqDSp9aIvLUzayIagZAjI39T0UukUCLWx2EkMhB96H6O43C7IYfSxzEhnemDN");
//echo count($photos['data']);
foreach($photos['data'] as $photo)
{
	$photoId = explode("_",$photo['source']);
	$photo['images']['width'] = 206;
	$photo['images']['height'] = 206;
	$photo206= str_replace("/s720x720/","/p206x206/",$photo['source']);
		echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin:2px 3px 3px 2px;padding:0px;border:none\" title=\"\" href='".$photo['images'][0]['source']."'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background-image:url('".$photo['images'][0]['source']."');display:block;width:206px;height:206px;border:0px\"/></div></a><div class=\"user_like\" style=\"margin: -20px 0px 1px 2px;text-align: center;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;background:#2A49A5 url('img/like.png')left top no-repeat;padding: 3px 5px;box-shadow: 0 1px #4C6BC7 inset;border: 1px solid #082783;-moz-user-select: none;color: white;text-shadow: 0 -1px 0 #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href=\"http://www.facebook.com/photo.php?fbid=$photoId[1]&set=a.419597978077914.84383.348722635165449&type=3&permPage=1\" target=\"_blank\">D&iacute; che ti Piace questa Foto</a></p><p class=\"storia\"><a id=\"inline_$photo[id]\" class=\"dog_story\" style=\"display:block;width:194px;text-decoration:none;background-color: rgb(107, 107, 107);padding: 3px 5px;box-shadow: 0 1px rgb(189, 185, 185) inset;border: 1px solid rgb(7, 7, 7);-moz-user-select: none;color: white;text-shadow: 0 -1px 0 rgb(107, 107, 107);font: 12px Verdana, sans-serif;text-indent:12px\" href=\"#storia2_$photo[id]\">Grazie a...</a></p></div></div><div style=\"display:none\"><div id=\"storia2_".$photo[id]."\"><p style=\"width:300px;height:auto;word-wrap:wrap\">".$photo['name']."</p></div></div>";
?>
<script>
$(function(){
	$('a#inline_<?=$photo['id']?>').fancybox({
		'CloseOnContentClick':true
		});
	})
</script>

<?php
}
?>
<script>
$(function(){
    $('.dogContainer a.dogDetail').lightBox();
	
	})
	
</script>