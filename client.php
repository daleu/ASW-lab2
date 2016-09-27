<?php

$URI = 'http://localhost:8080/waslab02/wall.php';
$alltweets = new SimpleXMLElement(file_get_contents($URI));
echo $http_response_header[0], "\n"; // Print the first HTTP response header
//echo $resp;  // Print HTTP response body
foreach($alltweets->tweet as $tweet) {
  echo '[Tweet: #',$tweet["id"],'] ', $tweet->author , ': ', $tweet->text, ' [' , $tweet->time, ']', PHP_EOL;

}
?>