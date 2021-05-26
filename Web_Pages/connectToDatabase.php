<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$dbConn = new mysqli("localhost", "root", "", "Users");

// Check connection
if ($dbConn->connect_error) {
  die("Connection failed: " . $dbConn->connect_error);
  //echo json_encode("The connection to the database has failed");
}
  //echo json_encode("Connected successfully");
?>