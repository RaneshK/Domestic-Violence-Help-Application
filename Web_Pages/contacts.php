<?php
// Obtain the session variables
session_start();

/* Add a contact into the database */
if (isset($_POST['submit'])){

    // Connect to the database
     $dbConn = new mysqli("localhost", "root", "", "Users");

     if($dbConn->connect_error){
         die("The connection to the database has failed" . $dbconn->connect_error);
     }
 
 
     // Generate a unique ID for each contact
     @$contactID = uniqid();
     echo $contactID;
     // Create a session variable with the contact's ID, to be used to update the contact's details
     //$_SESSION["contactID"] = $contactID;
     // Store the user's details in variables
     @$phoneNumber =  $dbConn->escape_string($_POST['phoneNumber']);
     @$fName = $dbConn->escape_string($_POST['fName']);
     @$lName = $dbConn->escape_string($_POST['lName']);
     $userID = $_SESSION["ID"];

    $sql = "INSERT INTO `Contacts`(`contactID`, `PhoneNumber`, `firstName`, `lastName`, `UserID`) VALUES ('$contactID','$phoneNumber','$fName','$lName','$userID')";
     //$sql = "INSERT INTO `Contacts`(`contactID`, `PhoneNumber`, `firstName`, `lastName`, `UserID`) VALUES ('$contactID','$phoneNumber','$fName','$lName','$userID')";


     // Perform the sql query
    if (mysqli_query($dbConn, $sql)){
        //echo "Success";
    } else {
        echo "Something went wrong";
        echo("Error description: " . mysqli_error($dbConn));
        }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title> Contacts </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>

        <div>
    <?php
    // Holds the link to the login or logout page based on if the user is logged in or out
    $log = "";

    // Dynamically allocates the user with the correct login or logout link
    if(@$_SESSION['loggedin'] == true){
        // The user is logged in
        $log = "logout.php";
    } else {
        // The user is not logged in 
        $log = "login.php";
    }
?>
<nav>
    <a href="http://127.0.0.1"><img src="images/logo.png" alt="Text with image that says rose petals"></a>
    <div class="nav-links">
        <ul>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="updateDetails.php">My Account</a></li>
            <li><a href="<?php echo $log ?>"><?php if (@$_SESSION['loggedin'] == true){
                    echo "Log Out";
                } else {
                    echo "Log In";
                } ?></a></li>
        </ul>
    </div>
</nav>
</div>

<div class="grid-container">
    <!-- Add a contact form -->
    <div class="form">
        <div class="column">
            <div class="container-fluid forms">
                <div class="row justify-content-center">
                    <form class="form-container" method="post" action="contacts.php">
                        <h1 style="text-align: center;"> Add a Contact </h1>
                        <div class="form-group input-group mb-4">
                            <span class="input-group-text">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" name="fName" placeholder="First Name">
                        </div>
                        <div class="form-group input-group mb-4">
                            <span class="input-group-text">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" name="lName" placeholder="Last Name">
                        </div>
                        <div class="form-group input-group mb-4">
                            <span class="input-group-text">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control" name="phoneNumber" placeholder="0415 443 234">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }

    // Create a local variable of the user's ID 
    $temp = $_SESSION["ID"];

    // Create the sql query to get all the user's contacts
    $sql = "SELECT * FROM Contacts WHERE UserID = '$temp' ";

    // Perform the sql query
    $recordSet = $dbConn->query($sql); 

  // Get all the user's contacts
  while($row = $recordSet->fetch_assoc()){
      $CONTACT_PHONE_NUMBER = $row["PhoneNumber"];
      $CONTACT_FIRST_NAME = $row["firstName"];
      $CONTACT_LAST_NAME = $row["lastName"];
      $COTACT_CONTACT_ID = $row["contactID"];
      
    ?>
    <div class="cards">
    <div class="card-group">
    <div class="col-12">
        <div class="card" style="width: 18rem;">
            <div class="card-body mx-auto">
                <h5 class="card-title" style="text-align: center;">Contact</h5>
                <form method="post" action="updateContacts.php">
                    <div class="form-group">
                        <label for="contactFirstName">First Name</label>
                        <input type="text" class="form-control" name="contactFirstName"
                            value="<?php echo $CONTACT_FIRST_NAME ?>" placeholder="<?php echo $CONTACT_FIRST_NAME ?>"
                            placeholder="<?php echo $CONTACT_FIRST_NAME ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contactLastName">Last Name</label>
                        <input type="text" class="form-control" name="contactLastName"
                            value="<?php echo $CONTACT_LAST_NAME ?>"" placeholder=" <?php echo $CONTACT_LAST_NAME ?>"
                        required>
                    </div>
                    <div class="form-group">
                        <label for="contactPhoneNumber">Phone Number</label>
                        <input type="text" class="form-control" name="contactPhoneNumber"
                            value="<?php echo $CONTACT_PHONE_NUMBER ?>"
                            placeholder="<?php echo $CONTACT_PHONE_NUMBER ?>" required>
                    </div>
                    <input type="hidden" name="contactContactID" value="<?php echo $COTACT_CONTACT_ID ?>">
                    <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Update Details</button>
                    <button type="button" class="btn btn-danger" onclick='updateContacts("<?php echo $COTACT_CONTACT_ID ?>")'>Delete Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
    <?php 
  }
    ?>
    <!-- END OF THE GRID CONTAINER CLASS -->
</div>
<script>
    function updateContacts(contactId)
    {
        console.log(contactId)
        window.open('./deleteContacts.php?contactId='+contactId, '_self')
    }
</script>
</body>
<html>