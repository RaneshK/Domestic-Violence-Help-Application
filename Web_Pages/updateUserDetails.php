<?php
// Obtain the session variables
session_start();

$userID = $_SESSION["ID"];


 // Connect to the database
 $dbConn = new mysqli("localhost", "root", "", "Users");

      if($dbConn->connect_error){
          die("The connection to the database has failed" . $dbconn->connect_error);
      }

// Get the values from the form
if (isset($_POST['submit'])){
    $userFirstname = $_POST["userFirstName"];
    $userLastname = $_POST["userLastName"];
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];
}
   
    // Hash the password to store in the databse
    $hashedPassword = hash("sha256", $password);



// Create the SQL query to update the user's details
$sql = "UPDATE `User` SET `ID`='$userID',`firstName`='$userFirstname',`lastName`='$userLastname',`email`='$userEmail',`password`='$hashedPassword' WHERE `ID`='$userID' ";

// Perform the sql query
if (mysqli_query($dbConn, $sql)){
    // The user's details have successfully been updated
    // Redirect the user back to the editUserDetails.php page
    echo "Success";
    header("Location: updateDetails.php");
    exit();
} else {
    // Something has gone wrong will updating the user's details
    echo "Something went wrong";
    echo("Error description: " . mysqli_error($dbConn));
    }

?>