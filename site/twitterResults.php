<?php
$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
#determine the number of questions in the database
$query = "SELECT count(*) as count from question;";
mysql_select_db("frankendeal", $link);
$query = sprintf("SELECT max(twitter_id) as last_twitter_id from tweets",
		 mysql_real_escape_string($questionId));
$result = mysql_fetch_assoc(mysql_query($query));
$lastTwitterId = (string) $result["last_twitter_id"];

$ch = curl_init("http://search.twitter.com/search.json?q=@frankenbrain&since_id=" . $lastTwitterId);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
$json = json_decode($result);

foreach ($json ->{'results'} as $result)
{
  $fromUser = $result->{"from_user"};
  $id = $result->{"id"};
  $rawJson = json_encode($result);
  $body = $result->{"text"};
  $query = sprintf("insert into tweets (raw_json, body, twitter_id, twitter_username) values ('%s', '%s', %s, '%s')",
		   mysql_real_escape_string($rawJson), mysql_real_escape_string($body), mysql_real_escape_string($id), mysql_real_escape_string($fromUser));
  echo($query . "<br />");
  mysql_query($query);
  
}

mysql_close($link);
?>