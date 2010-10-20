<?php
$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
?>
  	failed to connect!
<?php
	die('Could not connect: ' . mysql_error());
  
}
else {
?>
        **** connected!
<?php

}
mysql_select_db("frankendeal", $link);
?>
        <p>changed to db.
<?php

#add new entry location entry
$query = sprintf("insert into location VALUES ('%s','%s');",
                 mysql_real_escape_string($_GET["lon"]), mysql_real_escape_string($_GET["lat"]));
$result = mysql_query($query);
$question = mysql_fetch_assoc($result);
?>
        <p>added  to db.
<?php


#select the question
$query = sprintf("select * from location where latitude = %s;",
		 mysql_real_escape_string($_GET["lat"]));

$result = mysql_query($query);
$question = mysql_fetch_assoc($result);
?>
        <p>read from db.
<?php

if ($question["lat"]){
?>
  SUCCESS! 
<?php
}
else {
?>
  <p>FAIL to add key 
<?php
	echo $question["lat"];
}
?>
