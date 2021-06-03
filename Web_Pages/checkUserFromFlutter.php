<?php
// Connect to the database
require "connectToDatabase.php";


// Temp the variables for the query
$userEmail = $_POST['email'];
$userPassword = $_POST['pass'];

// Hash the password to store in the databse
$hashedPassword = hash("sha256", $userPassword);


// Create the query
$sql = "SELECT * FROM User WHERE email = '$userEmail' AND password = '$hashedPassword'";

// Perform the SQL query
$recordSet = $dbConn->query($sql);

while ($row = $recordSet->fetch_assoc()){
	// Add the phone numbers and messages to the respective array
	$_SESSION["ID"] = $row["ID"];
}

$userID = $_SESSION["ID"];

// Check if the user exists
if ($recordSet->num_rows){
	// Send the user's ID back to the flutter app
	echo json_encode($userID);
} else {
	echo json_encode("No user");
}



?>

