<?php

require_once("DbHandler.php");
setlocale(LC_TIME,"en_US");
$dbhandler = new DbHandler();

$rss = new SimpleXMLElement('<rss version="2.0"></rss>');

$channel = $rss->addChild('channel');
$channel->title = "Wall of Tweets 2 - RSS Version";
$channel->link = "http://localhost:8080/waslab02/wall.php";
$channel->description = 'RSS 2.0 that retrieves the tweets posted to the web app "Wall of Tweets 2"';

$tweets = $dbhandler->getTweets();

foreach($tweets as $tweet) {
  $item = $channel->addChild('item');
  $item->title = $tweet['text'];
  $item->link = "http://localhost:8080/waslab02/wall.php#item_".$tweet['id'];
  $item->description = date("m/d/y h:i A", $tweet["time"]).'<br /> <br />This is WoT tweet #'.$tweet["id"].' posted by <b>'.$tweet["author"].'</b>. It has been liked by <b>'.$tweet["likes"].'</b> people';
}

echo $rss->asXML();

?>