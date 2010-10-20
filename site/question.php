<?php

##TODO preload all the images so there's no delay when buttons are clicked

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
<html>
<head>
<link rel=StyleSheet href="css/style.css" type="text/css">
</head>
<body>
<div class="question">
  <span class="questionIndicator">Q:</span>
  <span class="questionBody">
    <?php echo $question["text"] ?>
  </span>
</div>

<div class="clear">&nbsp;</div>

<a id="a" class="answer" href="#">
  <?php echo $question["answer_a"] ?></a>
<a id="b" class="answer" href="#">
  <?php echo $question["answer_b"] ?></a>
<a id="c" class="answer" href="#">
  <?php echo $question["answer_c"] ?></a>
<a id="d" class="answer" href="#">
  <?php echo $question["answer_d"] ?></a>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.js"></script>
<script>
  var correctAnswer = "<?php echo($question[answer]); ?>";
  var questionId = "<?php echo($question['id']); ?>";
  $(".answer").click(
    function(){
      $("#"+correctAnswer).css("background-image", "url(img/correct.png)");
      if ($(this)[0].id == correctAnswer)
      {
        var url = "answer.php?choice=" + correctAnswer + "&questionId=" + questionId
        setTimeout(function() {
          document.location = url;
	}, 3000);
      }
      else
      {
        console.log("incorrect answer");
        $(this).css("background-image", "url(img/incorrect.png)");
        setTimeout(function() {
          document.location = "question.php";
	}, 3000);
	redirect("question.php");
      }
    }
  );

</script>
</body>
</html>
