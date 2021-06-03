<?php

// Create and start the php session
session_start();

// Connect to the database
$dbConn = new mysqli("localhost", "root", "", "Users");

if($dbConn->connect_error){
   die("The connection to the database has failed" . $dbconn->connect_error);
}

if (isset($_POST['submit'])){
    // Store the username and password in variables	
    @$useremail =  $dbConn->escape_string($_POST['email']);
    @$password = $dbConn->escape_string($_POST['password']);

    // Hash the password to match with the databse
    $hashedPassword = hash("sha256", $password);

    // Create the SQL query to check if the user exists in the database
    $sql = "SELECT * FROM User WHERE email = '$useremail' AND password = '$hashedPassword'";

    // Perform the SQL query
    $recordSet = $dbConn->query($sql);

    // Check if the user exists in the database
    if($recordSet->num_rows){
        // Create and set session variables
        $_SESSION['loggedin'] = true;
        //echo "Working";
        
        $_SESSION["userEmail"] = $useremail;
	    while ($row = $recordSet->fetch_assoc()){
            // Create and set session variables
            $_SESSION["ID"] = $row['ID'];

        }
        // Redirect the user to the contacts page
        header("Location: contacts.php");
        exit();
    } 

    echo $_SESSION["ID"];
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <title> Login </title>
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
                <form class="form-container" method="post" action="login.php">
                    <h3> Login </h3>
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="JohnSmith@gmail.com"
                            required>
                    </div>
                    <div class="form-group input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="form-group btn btn-primary btn-block" name="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>