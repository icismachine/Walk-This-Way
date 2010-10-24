<?php

$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
#determine the number of questions in the database

mysql_select_db("frankendeal", $link);
$query = "select * from score order by id desc limit 1;";
$result = mysql_fetch_assoc(mysql_query($query));
echo $result;
?>
