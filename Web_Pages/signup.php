<?php
// Obtain the session variables
session_start();

if (isset($_POST['submit'])){
    // Connect to the database
$dbConn = new mysqli("localhost", "root", "", "Users");

if($dbConn->connect_error){
    die("The connection to the database has failed" . $dbconn->connect_error);
}

// Generate a unique ID for each user
@$uniqueID = uniqid();
// Store the user's details in variables
@$fname =  $dbConn->escape_string($_POST['fName']);
@$lname = $dbConn->escape_string($_POST['lName']);	
@$userEmail =  $dbConn->escape_string($_POST['email']);
@$password = $dbConn->escape_string($_POST['password']);


echo strval($fname);
echo strval($lname);
echo strval($userEmail);
echo strval($password);
echo strval($uniqueID);

// Create the sql query to insert the uesr into the database
$sql = "INSERT INTO `User`(`ID`, `firstName`, `lastName`, `email`, `password`) VALUES ('$uniqueID','$fname','$lname','$userEmail','$password')";

if ($recordSet = $dbConn->query($sql)){
    echo "Success";
    // Redirect the user to the contacts page
    header("Location: login.php");
    exit();
} else {
    echo "Something went wrong";
}
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, intial-scale=1">
  <title> Signup </title>
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

  <div class="container-fluid forms">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-md-3">
        <form class="form-container" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h3> Signup </h3>
          <div class="form-group input-group mb-3">
            <span class="input-group-text">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control" name="fName" placeholder="First Name" required>
          </div>
          <div class="form-group input-group mb-3">
            <span class="input-group-text">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" class="form-control" name="lName" placeholder="Last Name" required>
          </div>
          <div class="form-group input-group mb-3">
            <span class="input-group-text">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
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
</body>
</html>