<?php

session_start();
$userId = $_SESSION["ID"];
if (empty($userId)) {
  header('Location: ./login.php');
  exit;
}


if (!isset($_GET['contactId'])){
  header('Location: ./contacts.php');
  exit;
}

$sql = 'DELETE FROM `Contacts` WHERE `contactID` = "' . $_GET['contactId'] . '"';

$dbConn = new mysqli("localhost", "root", "", "Users");

if($dbConn->connect_error){
    die("The connection to the database has failed" . $dbconn->connect_error);
}

// Perform the sql query
if (mysqli_query($dbConn, $sql)){
    echo "Success";
    header("Location: contacts.php");
    exit();
} else {
    echo "Something went wrong";
    echo("Error description: " . mysqli_error($dbConn));
}
