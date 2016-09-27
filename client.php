<?php

$URI = 'http://localhost:8080/waslab02/wall.php';
$alltweets = new SimpleXMLElement(file_get_contents($URI));
echo $http_response_header[0], "\n"; // Print the first HTTP response header
foreach($alltweets->tweet as $tweet) {
  echo '[Tweet: #',$tweet["id"],'] ', $tweet->author , ': ', $tweet->text, ' [' , $tweet->time, ']', PHP_EOL;
}

$postdata = new SimpleXMLElement('<tweet></tweet>');
$postdata->author = "Test Author";
$postdata->text = "Test Text";

$opts = array('http' =>
    array(
        'method'  => 'PUT',
        'header'  => 'Content-type: text/xml',
        'content' => $postdata->asXML()
    )
);
$context = stream_context_create($opts);
$result = file_get_contents($URI, false, $context);
echo $result;
?>