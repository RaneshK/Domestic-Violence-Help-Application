<?php
// Obtain the session variables
session_start();

 // Create a local variable of the user's ID 
 $userId = $_SESSION["ID"];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title> Messages </title>
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
            <li><a href="contacts.php">Contacts</a></li>
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




    <?php 
    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }


    // Create the sql query to get all the user's messages
    $sql = "SELECT * FROM Messages WHERE messageOption = '1' AND userID = '$userId'";

    // Perform the sql query
    $recordSet = $dbConn->query($sql); 


  // Get all the user's messages
  while($row = $recordSet->fetch_assoc()){
      $USER_MESSAGE_BODY = $row["messageBody"];
      $USER_MESSAGE_OPTION = $row["messageOption"];

      
      ?>
      <!-- This is the form for the user to add their three messages
      -->
      <div class="row">
        <div class="col-sm-4 messageCards">
          <div class="card bg-success">
            <div class="card-body">
              <h5 class="card-title" style="text-align: center;  color: white;">Okay Message</h5>
                <form class="bg-success" method="post" action="updateMessages.php">
                    <div class="form-group">
                        <label for="userMessageBody" style="text-align: center; color: white;">Message Body</label>
                        <textarea name="userMessageBody" value="<?php echo $USER_MESSAGE_BODY ?>" rows="4" cols="50" placeholder="<?php echo $USER_MESSAGE_BODY ?>"></textarea>
                    </div>
                        <input type="hidden" name="userMessageOption" value="1">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Message</button>
                </form>
            </div>
          </div>
        </div>
        <?php 
  }
  ?>
        <?php 
    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }


    // Create the sql query to get all the user's messages
    $sql = "SELECT * FROM Messages WHERE messageOption = '2' AND userID ='$userId'";

    // Perform the sql query
    $recordSet = $dbConn->query($sql); 


  // Get all the user's messages
  while($row = $recordSet->fetch_assoc()){
      $USER_MESSAGE_BODY = $row["messageBody"];
      $USER_MESSAGE_OPTION = $row["messageOption"];

      
      ?>
        <div class="col-sm-4 messageCards">
          <div class="card bg-warning">
            <div class="card-body">
            <h5 class="card-title" style="text-align: center; color: white;">Getting Serious Message</h5>
            <form class="bg-warning" method="post" action="updateMessages.php">
                    <div class="form-group">
                        <label for="userMessageBody" style="text-align: center; color: white;">Message Body</label>
                        <textarea name="userMessageBody" value="<?php echo $USER_MESSAGE_BODY ?>" placeholder="<?php echo $USER_MESSAGE_BODY ?>" rows="4" cols="50"></textarea>
                    </div>
                        <input type="hidden" name="userMessageOption" value="2">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Message</button>
                </form>
            </div>
          </div>
        </div>
        <?php 
  }
  ?>
      <?php 
    // Connect to the database
    $dbConn = new mysqli("localhost", "root", "", "Users");

    if($dbConn->connect_error){
        die("The connection to the database has failed" . $dbconn->connect_error);
    }

    // Create the sql query to get all the user's messages
    $sql = "SELECT * FROM Messages WHERE messageOption = '3' AND userID = '$userId'";

    // Perform the sql query
    $recordSet = $dbConn->query($sql); 


  // Get all the user's messages
  while($row = $recordSet->fetch_assoc()){
      $USER_MESSAGE_BODY = $row["messageBody"];
      $USER_MESSAGE_OPTION = $row["messageOption"];

      
      ?>
        <div class="col-sm-4 messageCards">
            <div class="card bg-danger">
              <div class="card-body">
              <h5 class="card-title" style="text-align: center; color: white;">Need Help ASAP Message</h5>
              <form class="bg-danger" method="post" action="updateMessages.php">
                    <div class="form-group">
                        <label for="userMessageBody" style="text-align: center; color: white;">Message Body</label>
                        <textarea name="userMessageBody" value="<?php echo $USER_MESSAGE_BODY ?>" placeholder="<?php echo $USER_MESSAGE_BODY ?>" rows="4" cols="50"></textarea>
                    </div>
                        <input type="hidden" name="userMessageOption" value="3">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Message</button>
                </form>
              </div>
            </div>
          </div>
      </div>
      <?php 
  }
  ?> 
</body>