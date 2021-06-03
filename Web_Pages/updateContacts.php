<?php

// Obtain the session variables
session_start();

// Create a local variables of the user and contact ID's
$userId = $_SESSION["ID"];
//$contactID = $_SESSION["contactID"]; // I think this is the reason why youu can't update unless you add a contact


if (isset($_POST['submit'])){
    // Get the details entered in the form to update the user's details
    $CONTACTFIRSTNAME = $_POST['contactFirstName'];
    $CONTACTLASTNAME = $_POST['contactLastName'];
    $CONTACTPHONENUMBER = $_POST['contactPhoneNumber'];
    $CONTACTID = $_POST['contactContactID'];
    
}

    echo $userId;
    echo $CONTACTFIRSTNAME;
    echo $CONTACTLASTNAME;
    echo $CONTACTPHONENUMBER;
    
    // Create the sql query to update the contact's details
    $sql = "UPDATE `Contacts` SET `contactID`='$CONTACTID',`PhoneNumber`='$CONTACTPHONENUMBER',`firstName`='$CONTACTFIRSTNAME',`lastName`='$CONTACTLASTNAME',`UserID`='$userId' WHERE `contactID`='$CONTACTID'";


    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }


    // Perform the sql query
    if (mysqli_query($dbConn, $sql)){
        // The contact's details have successfully been updated
        // Redirect the user back to the contacts.php page
        echo "Success";
        header("Location: contacts.php");
        exit();
    } else {
        // Something has gone wrong will updating the contact's details
        echo "Something went wrong";
        echo("Error description: " . mysqli_error($dbConn));
        }

    


?>