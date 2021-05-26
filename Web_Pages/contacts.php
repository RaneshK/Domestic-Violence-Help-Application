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
     $_SESSION["contactID"] = $contactID;
     // Store the user's details in variables
     @$phoneNumber =  $dbConn->escape_string($_POST['phoneNumber']);
     @$fName = $dbConn->escape_string($_POST['fName']);
     @$lName = $dbConn->escape_string($_POST['lName']);
     @$messageID = $dbConn->escape_string($_POST['messageID']);
     $userID = $_SESSION["ID"];

    $sql = "INSERT INTO `Contacts`(`contactID`, `PhoneNumber`, `firstName`, `lastName`, `UserID`, `messageID`) VALUES ('$contactID','$phoneNumber','$fName','$lName','$userID','NULL')";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<?php
// Holds the link to the login or logout page based on if the user is logged in or out
$log = "";

if($_SESSION['loggedin'] == true){
	// The user is logged in
	$log = "Logout.php";
} else {
	// The user is not logged in 
	$log = "Login.php";
}
?>

    <nav>
        <img src="images/logo.png"></a>

        <div class="nav-links">
        <ul>
        <li><a href="index.html">Home</a><li>
		<li><a href="messages.php">Messages</a><li>
		<li><a href="<?php echo $log ?>"><?php if (@$_SESSION['loggedin'] == true){
	echo "Log Out";
} else {
	echo "Log In";
} ?></a></li>
</ul>
</div>
	</nav>
<div class="row">
  <div class="column" style="background-color:#aaa;">
  <div class="card" style="width: 18rem;" style="margin-left: 50%;">
  <div class="card-body">
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

    // Get the user's messages and store it in a array
    $getUsersMessages = "SELECT messageName FROM Messages where userID = '$temp'";

    $usermessages = array();

    // Perform the sql query
    $rs = $dbConn->query($getUsersMessages); 

    $counter = 0;

    while ($rows = $rs->fetch_assoc()){
        $usermessages[$counter] = $rows["messageName"];
        $counter = $counter + 1;
    }

  // Get all the user's contacts
  while($row = $recordSet->fetch_assoc()){
      $CONTACT_PHONE_NUMBER = $row["PhoneNumber"];
      $CONTACT_FIRST_NAME = $row["firstName"];
      $CONTACT_LAST_NAME = $row["lastName"];
      $CONTACT_MESSAGE_ID = $row["messageID"];
      $COTACT_CONTACT_ID = $row["contactID"];
      
      ?>
      <!-- This is the form to display the contact infomation of the user's contacts.
           This form sends the data to the updateContacts.php file to update the con-
           tacts information.
      -->
      <form method="post" action="updateContacts.php">
      <h5 class="card-title" style="text-align: center;">Contact</h5>
      <div class="form-group">
        <label for="contactFirstName">First Name</label>
        <input type="text" class="form-control" name="contactFirstName" value="<?php echo $CONTACT_FIRST_NAME ?>" placeholder="<?php echo $CONTACT_FIRST_NAME ?>" placeholder="<?php echo $CONTACT_FIRST_NAME ?>" required>
    </div>
    <div class="form-group">
        <label for="contactLastName">Last Name</label>
        <input type="text" class="form-control" name="contactLastName" value="<?php echo $CONTACT_PHONE_NUMBER ?>"" placeholder=" <?php echo $CONTACT_LAST_NAME ?>" required>
    </div>
    <div class="form-group">
        <label for="contactPhoneNumber">Phone Number</label>
        <input type="text" class="form-control" name="contactPhoneNumber" value="<?php echo $CONTACT_PHONE_NUMBER ?>" placeholder="<?php echo $CONTACT_PHONE_NUMBER ?>" required>
    </div>
    <div class="form-group">
        <label for="contactMessageToSend">Message To Send</label>
        <select class="form-control" name="contactMessageToSend">
            <?php 
                        $anotherCounter = 0;
                        while ($anotherCounter < count($usermessages)){
                            ?>
                            <option><?php echo $usermessages[$anotherCounter]; ?></option>
                            <?php
                            $anotherCounter = $anotherCounter + 1;
                        }
                            ?>
        </select>
    </div>
        <input type="hidden" name="contactContactID" value="<?php echo $COTACT_CONTACT_ID ?>">
        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Details</button>
        </form>
      <?php 
  }
  
  
  
  
  ?>
  </div>

  <!-- This is the form to add a contact -->
</div>
  </div>
  <div class="column">
  <div class="card">
    <div class="login-container">
        <form class="login-form" method="post" action="contacts.php">
            <h1> Add a Contact </h1>
                <div class="form-group">
                   <input type="text" class="form-control" name="fName" placeholder="First Name">
                <div>
                <div class="form-group">
                   <input type="text" class="form-control" name="lName" placeholder="Last Name">
                <div>
                <div class="form-group">
                   <input type="text" class="form-control" name="phoneNumber" placeholder="0415 443 234">
                <div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
        </form>
    </div>
</div>
  </div>
</div>
</body>
</html>
