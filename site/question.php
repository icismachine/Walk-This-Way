<?php

$link = mysql_connect('localhost', 'root', 's3cr3t');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("frankendeal", $link);

#determine the number of questions in the database
$query = "SELECT count(*) as count from question;";
$result = mysql_query($query);
$resultRow = mysql_fetch_assoc($result);
$questionCount = $resultRow["count"];

#pick a random question

$questionId = rand(1, $questionCount);
$query = sprintf("SELECT * from question where id = %s;",
		 mysql_real_escape_string($questionId));
$result = mysql_query($query);
$question = mysql_fetch_assoc($result);
mysql_close($link);
?>

<h1><?php echo $question["text"] ?></h1>
<ul>
<li><a href="answer.php?choice=a&questionId=<?php echo $questionId ?>">
  <?php echo $question["answer_a"] ?></a>
<li><a href="answer.php?choice=b&questionId=<?php echo $questionId ?>">
  <?php echo $question["answer_b"] ?></a>
<li><a href="answer.php?choice=c&questionId=<?php echo $questionId ?>">
  <?php echo $question["answer_c"] ?></a>
<li><a href="answer.php?choice=d&questionId=<?php echo $questionId ?>">
  <?php echo $question["answer_d"] ?></a>
</ul>
