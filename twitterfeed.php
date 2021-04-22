<?php
require_once('twitterfeed/TwitterFeed.php'); 
header('Content-Type: application/json');
$twitterFeed = new TwitterFeed('ACPA_Cesena', 1);
$twitterFeed->getTweets();
?>