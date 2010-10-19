<?php
$ch = curl_init("http://api.foursquare.com/v1/venues.json?geolat=37.760149&geolong=-122.420726&l=50");
curl_setopt($ch, CURLOPT_USERPWD, "rissem@gmail.com:berest1024");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
?>
<body>
Nearby Venues
<script>
var venues = <?php echo $result ?>;
for (var i = 0; i < venues.groups.length; i++){
  if (venues.groups[i].type == "Nearby"){
    for (var j = 0; j < venues.groups[i]["venues"].length; j++){
      var venue = venues.groups[i]["venues"][j];
      document.write(venue.name + "<br />");
    }
  }
 }
</script>
</body>