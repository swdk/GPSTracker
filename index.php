<?php




$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "tracer";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$result = mysqli_query($conn, "SELECT * FROM tracer.record Limit 5");

$lat=array();
$lng=array();
$row_count=0;

while ($row = mysqli_fetch_row($result)){
 	array_push($lat,$row[2]);
 	array_push($lng,$row[3]);
 	$row_count = $row_count +1;
}


?>

<html>
<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map { height: 100% }
    </style>

<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-p05tp3lwKpRhVXvZFyc25DBeClGnZZA&sensor=true">
       </script>
      <script type="text/javascript">
var geocoder;
var map;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();



var locations = [];
var lat = <?php echo json_encode($lat ); ?>;
var lng = <?php echo json_encode($lng ); ?>;
for (var i=0;i<"<?php echo $row_count ?>";i++){
	var tempstring = ['', lat[i], lng[i]];
	locations.push(tempstring);
	console.log(locations);
 }



function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();


  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(-33.92, 151.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  directionsDisplay.setMap(map);
  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var request = {
    travelMode: google.maps.TravelMode.DRIVING
  };
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
    if (i == 0) request.origin = marker.getPosition();
    else if (i == locations.length - 1) request.destination = marker.getPosition();
    else {
      if (!request.waypoints) request.waypoints = [];
      request.waypoints.push({
        location: marker.getPosition(),
        stopover: true
      });
    }

  }
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
google.maps.event.addDomListener(window, "load", initialize);

</script>

<body>
    <div id="map"/>
  </body>
</html>

