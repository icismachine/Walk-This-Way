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
$ch = curl_init("http://api.foursquare.com/v1/venues.json?geolat=37.760149&geolong=-122.420726&l=50");
curl_setopt($ch, CURLOPT_USERPWD, "rissem@gmail.com:berest1024");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
?>

<div class="points">+40</div>
<!--TODO remove hardcoded score and replace with correct answers * N -->
<div class="totalScore">Total Score: 540</div>
<a class="play_button" href="Play Again"></a>
Check in on FourSquare to be entered into a raffle.

<select id="foursquareVenues"></select>
<script>
var venues = <?php echo $result ?>;
var options = "";
for (var i = 0; i < venues.groups.length; i++){
  if (venues.groups[i].type == "Nearby"){
    for (var j = 0; j < venues.groups[i]["venues"].length; j++){
      var venue = venues.groups[i]["venues"][j];
      options += "<option value='" + venue.name + "'>" + venue.name + "</option>";
    }
  }
}
document.getElementById("foursquareVenues").innerHTML = options;
</script>
<a class="plain_button" href="confirmation.php">Check In</a>
<?php
}
else {
?>
  FAIL
<?php
}
?>