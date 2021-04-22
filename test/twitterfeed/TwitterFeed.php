<?php
require_once('twitteroauth.php');

class TwitterFeed {
	public $user;
	public $tweetsNumber;
	private $consumerKey = 'JnkrqS25gG0PENCrJ7xjw';
	private $consumerSecret = 'UpaNnqOCt2RkExgzCmcBpjzZ1wqjYmBSBB1SLAw0';
	private $accessToken = '93292377-2IoNvq4kpX8gCNnockr6epZ5COcLizp6Mkq5rC5p3';
	private $accessTokenSecret = 'f8Fg6LxInXR78UWqMs7TJFwFCmPE6ksMgHn5gYsM';
	private $connection;
	
	public function __construct($username, $tweets) {
		$this->user = $username;
		$this->tweetsNumber = $tweets;
		$this->connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $this->accessToken, $this->accessTokenSecret);
	}
	
	public function getTweets() {
		$tweets = $this->connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $this->user . '&count=' . $this->tweetsNumber);
		echo json_encode($tweets);
	}
	
}