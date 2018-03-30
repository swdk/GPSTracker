<?php




$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "tracer";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);


// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 
// echo "Connected successfully";
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$user_id = $_GET['user_id'];





$sql = "INSERT INTO record (user_id, lat,lng,recordtime )
VALUES ($user_id,$lat,$lng,'')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
