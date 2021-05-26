<?php 
// This obtains all of the current session variables
session_start();

// This removes all the session variables of the user's current session 
session_destroy();

// This redirects the user to the back to the homepage of the website
header("Location: index.html");

?>
