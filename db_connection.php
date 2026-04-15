<?php 
$servername = "localhost";
$username = "root";
$pass = "";
$database = "lesson_db";
$port = 3307;

$connection = mysqli_connect($servername, $username, $pass, $database, $port);

if(!$connection){
    die("Connection Failed: " . mysqli_connect_error());
}
?>