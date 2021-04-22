<?php include 'classes/header.php';?>
<div class="container">
<?php
require_once 'Facebook/autoload.php';
use Facebook\Facebook;

$config = array(
    'app_id' => '255431195198167',
    'app_secret' => 'a687e2ee5f18b5aeb6cd0a957c95fa23',
);

$facebook = new Facebook($config);
try {
    // Returns a `FacebookFacebookResponse` object
    $response = $facebook->get(
        'acpa.cesena/events?fields=cover,name,description,start_time,end_time,id',
        'EAADoUDWngtcBAGIqM3H9DQNJZBKslDe2ZBh5cc7rNpqRKvwLLRUFyFhHlYQ4kqZBzZCwxc9KJiHrAAvT1uKfYa2iVXmWua6ZAFej9myOCJjiFj0D5cmEEPuf3ZCp5T65cZCxYNzz2JD7uB4jwCJRv5UVbX5VWn8cNVLnYsfblyyPXVFWWm6NWK9'
    );
} catch(FacebookExceptionsFacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$graphNode = $response->getGraphEdge()->asArray();
//var_dump($graphNode);
foreach($graphNode as $events):
?>
<div class="row">
<div class="col-md-4">
<img src="<?php echo $events['cover']['source'];?>" class="rounded-square img-responsive img-thumbnail">
</div>
<div class="col-md-8">
<h1 class="eventTitle"><?php echo $events['name'];?></h1>
<i class="fa fa-calendar"></i> <?php echo $events['start_time']->format('d/m/Y - H:m:s');?><br>
<?php echo isset($events['end_time'])?'<i class="fa fa-calendar"></i> '.$events['end_time']->format('d/m/Y - H:m:s'):"";?>
<p id="<?php echo $events['id'];?>"><?php echo ltrim($events['description']);?></p>
<!-- <p><a class="btn" data-toggle="collapse" data-target="<?php echo "#".$events['id'];?>">Leggi Tutto &raquo;</a></p> -->
</div>
</div>
<hr>
<?php endforeach;?>
</div>
<?php include 'classes/footer.php';?>
	

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
</body>
</html>