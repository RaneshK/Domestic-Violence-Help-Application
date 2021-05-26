<?php
// Obtain the session variables
session_start();

/* Add a Message into the database */
if (isset($_POST['submit'])){

    // Connect to the database
     $dbConn = new mysqli("localhost", "root", "", "Users");

     if($dbConn->connect_error){
         die("The connection to the database has failed" . $dbconn->connect_error);
     }
 
 
     // Generate a unique ID for each message
     @$messageID = uniqid();
     // Create a session variable with the messageID
     $_SESSION["messageID"] = $messageID;
     // Store the user's details in variables
     @$messageName =  $dbConn->escape_string($_POST['mName']);
     @$messageBody =  $dbConn->escape_string($_POST['mBody']);
     
     $userID = $_SESSION["ID"];

     $sql = "INSERT INTO `Messages`(`messageID`, `messageName`, `messageBody`, `userID`) VALUES ('$messageID','$messageName','$messageBody','$userID')";


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
    <title> Message </title>
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
		<li><a href="contacts.php">Contacts</a><li>
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

    // Create the sql query to get all the user's messages
    $sql = "SELECT * FROM Messages WHERE UserID = '$temp' ";

    // Perform the sql query
    $recordSet = $dbConn->query($sql); 


  // Get all the user's messages
  while($row = $recordSet->fetch_assoc()){
      $USER_MESSAGE_NAME = $row["messageName"];
      $USER_MESSAGE_BODY = $row["messageBody"];
      $USER_MESSAGE_ID = $row["messageID"];
      
      ?>
      <!-- This is the form to display the user's messages. This form submits data
           to updateMessages.php. 
      -->
      <form method="post" action="updateMessages.php">
      <h5 class="card-title" style="text-align: center;">Message</h5>
      <div class="form-group">
        <label for="userMessageName">Message Name</label>
        <input type="text" class="form-control" name="userMessageName" value="<?php echo $USER_MESSAGE_NAME ?>" placeholder="<?php echo $USER_MESSAGE_NAME ?>">
    </div>
    <div class="form-group">
        <label for="userMessageBody">Message Body</label>
        <input type="text" class="form-control" name="userMessageBody" value="<?php echo $USER_MESSAGE_BODY ?>" placeholder="<?php echo $USER_MESSAGE_BODY ?>">
    </div>
    <input type="hidden" name="userMessageID" value="<?php echo $USER_MESSAGE_ID ?>">
        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Message</button>
        </form>
      <?php 
  }
  ?>
  </div>

  <!-- This is the form to add a Message -->
</div>
  </div>
  <div class="column">
  <div class="card">
    <div class="login-container">
        <form class="login-form" method="post" action="messages.php">
            <h1> Add a Message </h1>
                <div class="form-group">
                   <input type="text" class="form-control" name="mName" placeholder="Message Name">
                <div>
                <div class="form-group">
                   <input type="text" class="form-control" name="mBody" placeholder="Message Body">
                <div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
        </form>
    </div>
</div>
  </div>
</div>
</body>
</html>
