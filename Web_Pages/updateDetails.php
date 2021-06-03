<?php
// Obtain the session variables
session_start();

$userID = $_SESSION["ID"];

?>

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
            <li><a href="contacts.php">Contacts</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="<?php echo $log ?>"><?php if (@$_SESSION['loggedin'] == true){
                    echo "Log Out";
                } else {
                    echo "Log In";
                } ?></a></li>
        </ul>
    </div>
</nav>
</div>



<!DOCTYPE html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title> Edit Your Details </title>
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




    <?php

  $dbConn = new mysqli("localhost", "root", "", "Users");

  if($dbConn->connect_error){
      die("The connection to the database has failed" . $dbconn->connect_error);
  }


  // Create the sql query to get all the user's messages
  $sql = "SELECT * FROM User WHERE ID = '$userID' ";

  // Perform the sql query
  $recordSet = $dbConn->query($sql); 


  // Get all the user's details
  while($row = $recordSet->fetch_assoc()){
    $USER_FNAME = $row["firstName"];
    $USER_LNAME = $row["lastName"];
    $USER_EMAIL = $row["email"];
    $USER_PASSWORD = $row["password"];


    ?>

    <div class="container-fluid forms">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-6 col-md-3">
            <form class="form-container" method="post" action="updateUserDetails.php">
              <h3> Edit Your Details </h3>
              <div class="form-group input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" name="userFirstName" value="<?php echo $USER_FNAME ?>" placeholder="<?php echo $USER_FNAME ?>" required>
              </div>
              <div class="form-group input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" name="userLastName" value="<?php echo $USER_LNAME ?>" placeholder="<?php echo $USER_LNAME ?>" required>
              </div>
              <div class="form-group input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                <input type="email" class="form-control" name="email" value="<?php echo $USER_EMAIL ?>" placeholder="<?php echo $USER_EMAIL ?>" required>
              </div>
              <div class="form-group input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key" aria-hidden="true"></i>
                </span>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
          </div>
        </div>
    </div>
    <?php
  }
    ?>
</body>
<html>