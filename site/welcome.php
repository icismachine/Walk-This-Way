<?php
#TODO log the lattitude, longitude, phoneId to the database
?>
<html>
<head>
<link rel=StyleSheet href="css/style.css" type="text/css">
</head>
<body>
<h4>How to Play</h4>
Each round has 5 questions

<h4>Earning Raffle Tickets</h4>
You earn tickets each time you complete a round of trivia:

<ul>
<li>1 ticket for each correct answer
<li> +1 ticket per location specified
</ul>

Enter your email so we can contact you if you win!   We promise not to spam you.<br />

<input type="text" name="email" size="60"></input>
<a class="play_button" href="question.php">Play Trivia</a>

<!--
<h2>Debugging:</h2>
<ul>
  <li>Lattitude = <?php echo($_GET["lattitude"]) ?>
  <li>Lattitude = <?php echo($_GET["longitude"]) ?>
  <li>Distance Uncertainty = <?php echo ($_GET["uncertainty"]) ?>
  <li>Phone Id = <?php echo ($_GET["phoneId"]) ?>
</ul>
-->
</body>
</html>