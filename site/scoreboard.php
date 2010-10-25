
<?php
$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
#get the latest roundId
$query = "SELECT max(id) as latestRoundId from round ;";
$result = mysql_fetch_assoc(mysql_query($query));
$latestRoundId = $result["latestRoundId"];

#get the scores for this round
$query = "SELECT * from score where round = " . $latestRoundId . " order by amt desc ";
$result = mysql_fetch_assoc(mysql_query($query));
echo $result;

#group by userId and sum


#join 


mysql_close($link);
?>