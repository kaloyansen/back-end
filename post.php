<?php
include("db_connect.php");
  $url = 'http://127.0.0.1/api/tickets';
  $data = array('title' => 'post ticket', 'body' => 'post envoyé via l API', 'status' => 'A FAIRE', 'ActualPosition' => 'Create', 'color' => 'R');
  // utilisez 'http' même si vous envoyez la requête sur https:// ...
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  if ($result === FALSE) { /* Handle error */ }
  var_dump($result);
?>