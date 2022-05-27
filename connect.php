<?php
$servername = "localhost";
$uname = "root";
$pass = "";
$db = "coursedu";
// Create connection
$conn = mysqli_connect($servername, $uname, $pass,$db);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
?>