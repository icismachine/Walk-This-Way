<?php
#TODO log the lattitude, longitude, phoneId to the database
?>

<h1>Welcome User!</h1> <br />
<a href="question.php">Play Game</a>
<h2>Debugging:</h2>
<ul>
  <li>Lattitude = <?php echo($_GET["lattitude"]) ?>
  <li>Lattitude = <?php echo($_GET["longitude"]) ?>
  <li>Distance Uncertainty = <?php echo ($_GET["uncertainty"]) ?>
  <li>Phone Id = <?php echo ($_GET["phoneId"]) ?>
</ul>
