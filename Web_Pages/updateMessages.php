<?php

// Obtain the session variables
session_start();

// Create a local variables of the user and message ID's
$userId = $_SESSION["ID"];
//$MID = $_SESSION["messageID"];




if (isset($_POST['submit'])){
    // Get the details entered in the form to update the user's message
    $USERMESSAGEBODY = $_POST['userMessageBody'];
    $USERMESSAGEOPTION = $_POST['userMessageOption'];
    $USERMESSAGEID = $_POST['userMessageID'];
}

    echo $messageID;
    echo "               ";
    echo $USERMESSAGEBODY;
    echo "               ";

    // Create the sql query to update the user's message
    $sql = "UPDATE `Messages` SET `messageBody`='$USERMESSAGEBODY',`userID`='$userId',`messageOption`='$USERMESSAGEOPTION' WHERE `messageOption`='$USERMESSAGEOPTION' AND userID = '$userId' ";

    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }

   // Perform the sql query
   if (mysqli_query($dbConn, $sql)){
    // The message details have successfully been updated
    // Redirect the user back to the messages.php page
    echo "Success";
    header("Location: messages.php");
    exit();
    } else {
    // Something has gone wrong will updating the user's message
    echo "Something went wrong";
    echo("Error description: " . mysqli_error($dbConn));
    }

    
    


?>