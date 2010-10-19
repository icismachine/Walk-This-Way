<?php
$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("frankendeal", $link);

#select the question
$query = sprintf("select * from question where id = %s;",
		 mysql_real_escape_string($_GET["questionId"]));
$result = mysql_query($query);
$question = mysql_fetch_assoc($result);

if ($_GET["choice"] == $question["answer"]){
?>
  SUCCESS! <a href="foursquareLoginForm.php">Login with FourSquare</a> to claim your prize.  
<?php
}
else {
?>
  FAIL
<?php
}
?>