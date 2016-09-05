<?php
require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$access_token = '2394706651-xdmZjnpR8R0wAVg9TitXsf2Y6ONQN5P9IMsKz1F';
$access_token_secret = 'uMTIJB5Su43HtNz6v016W7SK2PFHbRUV0OeFSa6i8BfES';
$consumer_key = 'VohpocERhguq91N3rfbhys2Nv';
$consumer_secret = 'UQEV8cTQ8nD8MkT93NLOlyZMhPsqRqJMpQ7M6blpniVubLJopD';

$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

$USER_ID = 73779851;
$USER_SCREEN = "lucasmvr_";
/* FOLLOWING !!! */
// $cursor = -1;
// $count = 1;
// $arr = array();
// do{
//   $friends = $connection->get("friends/list", ["user_id" => $USER_ID, "count" => 200,"cursor" => $cursor]);

//   $node1 = array("group" => "nodes","data" => array("id" => $USER_SCREEN));
//   //var_dump($friends->users);
//   foreach($friends->users as $friend):
//     echo $count." ".$friend->screen_name."<br>";
//     $node2 = array("group" => "nodes","data" => array("id" => $friend->screen_name));
//     $edge = array("group" => "edges","data" => array("id" => $USER_SCREEN.$friend->screen_name, "source" => $USER_SCREEN, "target" => $friend->screen_name));

//     array_push($arr, $node1, $node2, $edge);
//     $count++;
//   endforeach;

//   $cursor = $friends->next_cursor;
// }while($cursor != 0);

// echo "<br><br><br><br><br><br>";

// echo json_encode($arr);


/* FOLLOWERS */
$cursor = -1;
$count = 1;
$arr = array();
do{
  $friends = $connection->get("followers/list", ["user_id" => $USER_ID, "count" => 200,"cursor" => $cursor]);
  $node2 = array("group" => "nodes","data" => array("id" => $USER_SCREEN));
  //var_dump($friends->users);
  foreach($friends->users as $friend):
    echo $count." ".$friend->screen_name."<br>";
    $node1 = array("group" => "nodes","data" => array("id" => $friend->screen_name));
    $edge = array("group" => "edges","data" => array("id" => $friend->screen_name.$USER_SCREEN, "source" => $friend->screen_name, "target" => $USER_SCREEN));

    array_push($arr, $node1, $node2, $edge);
    $count++;
  endforeach;

  $cursor = $friends->next_cursor;
}while($cursor != 0);

echo "<br><br><br><br><br><br>";

echo json_encode($arr);
?>