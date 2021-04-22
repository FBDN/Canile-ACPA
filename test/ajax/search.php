<?php
require_once '../Facebook/autoload.php';
use Facebook\Facebook;

$config = array(
    'app_id' => '255431195198167',
    'app_secret' => 'a687e2ee5f18b5aeb6cd0a957c95fa23',
);

$facebook = new Facebook($config);
//$user_profile = $facebook->get('/acpa.cesena');
//$albums = $facebook->get('/acpa.cesena/albums');
//$photos = $facebook->get("/419597978077914/photos?fields=images");
$helper = $facebook->getDefaultAccessToken();
try {
    $album = intval($_POST['album']);
    $token = '255431195198167|XANTajp_vIK_Xv4-gYChBOS5H8U';
    $query ="/".$album."/photos?fields=images,name";
    $albumQuery = "/".$album."?fields=name";
    $albumName = $facebook->get($albumQuery, $token)->getGraphNode()->asArray();
    //var_dump($query);
    $photos = $facebook->get($query, $token)->getGraphEdge()->asArray();
    //var_dump($photos);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
   
}
?>
<div class="content col-md-12 bg-success">
<h1><?php echo $albumName['name']?></h1>
</div>
<?php 
//echo count($photos['data']);
foreach($photos as $photo)
{
    //echo "<div class=\"dogContainer\" style=\"position:relative;display:inline-block\"><a class=\"dogDetail\" style=\"display:inline-block;margin:2px 3px 3px 2px;padding:0px;border:none\" title=\"\" href='".$photo['images'][0]['source']."'><div style=\"overflow:hidden;position:relative\"><img style=\"background-color:transparent;z-index:2;position:relative;background-image:url('".$photo['images'][0]['source']."');display:block;width:206px;height:206px;border:0px\"/></div></a><div class=\"user_like\" style=\"margin: -20px 0px 1px 2px;text-align: center;\"><p><a class=\"user_like_button\" style=\"display:block;width:194px;text-decoration:none;background:#2A49A5 url('img/like.png')left top no-repeat;padding: 3px 5px;box-shadow: 0 1px #4C6BC7 inset;border: 1px solid #082783;-moz-user-select: none;color: white;text-shadow: 0 -1px 0 #082783;font: 12px Verdana, sans-serif;text-indent:12px\" href=\"http://www.facebook.com/photo.php?fbid=$photoId[1]&set=a.419597978077914.84383.348722635165449&type=3&permPage=1\" target=\"_blank\">D&iacute; che ti Piace questa Foto</a></p><p class=\"storia\"><a id=\"inline_$photo[id]\" class=\"dog_story\" style=\"display:block;width:194px;text-decoration:none;background-color: rgb(107, 107, 107);padding: 3px 5px;box-shadow: 0 1px rgb(189, 185, 185) inset;border: 1px solid rgb(7, 7, 7);-moz-user-select: none;color: white;text-shadow: 0 -1px 0 rgb(107, 107, 107);font: 12px Verdana, sans-serif;text-indent:12px\" href=\"#storia2_$photo[id]\">Grazie a...</a></p></div></div><div style=\"display:none\"><div id=\"storia2_".$photo[id]."\"><p style=\"width:300px;height:auto;word-wrap:wrap\">".$photo['name']."</p></div></div>";
 
?>	

<div class="imageResult col-sm-12 col-md-3 center-block">
						<img class="center_cropped img-responsive img-thumbnail"  src="<?php echo $photo['images'][0]['source']?>">
					    <div class="caption">
					    <div class="title text-truncate">
					    <?php echo $photo['name']?>
					    </div>
    </div>
</div>
<?php }?>