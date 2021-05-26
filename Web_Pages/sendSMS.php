<?php 
// Start the session to check if the user is logged in or not on this page and all the other neccessary pages
session_start();

// Get the user's contact details

// Create a temp variable
$userID = $_GET['id'];

// 1.) Get all the user's contact numbers
// 2.) Get all the messages to be sent
// 3.) Send all the messages

// The Arrays needed
$messageIDs = array();
$phoneNumbers = array();
$messages = array();

$counter = 0;
$counterTwo = 0;
$countForSending = 0;
$countForSendingTwo = 0;
// This is the SQL query to get all the user's contacts
$mainQuery = "SELECT * FROM Contacts WHERE UserID = '$userID'";

// Loop through everythhing returned from the mainQuery
// Connect to the database and perform the query

$dbConn = new mysqli("localhost", "root", "", "Users");

	if($dbConn->connect_error){
		die("The connection to the database has failed" . $dbconn->connect_error);
	}

    // Perform the query to get the user's contacts
    $rs = $dbConn->query($mainQuery);


    if ($rs->num_rows){
        
        while ($row = $rs->fetch_assoc()){
            // Add the phone numbers and messages to the respective array
            $phoneNumbers[$counter] = $row["PhoneNumber"];
            $messageIDs[$counter] = $row["messageID"];
            $counter = $counter + 1;
        }
    }
/* echo "HELLO";
echo "This is phoneNumbers postion 0 " . strval($phoneNumbers[0]);
echo "This is phoneNumbers postion 1" . strval($phoneNumbers[1]);
echo "                ";
echo "This is messageIDs postion 0: " . strval($messageIDs[0]);
echo "This is messageIDs postion 1: " . strval($messageIDs[1]);
 */

// Get the message bodies using the messageID's
foreach ($messageIDs as $ID){

    $sql = "SELECT `messageBody` FROM `Messages` WHERE `messageID` = '$ID'";
    $rs = $dbConn->query($sql);

    if ($rs->num_rows){
        
        while ($row = $rs->fetch_assoc()){
            // Add the phone numbers and messages to the respective array
            $messages[$counterTwo] = $row["messageBody"];
            $counterTwo = $counterTwo + 1;
        }

       

}
}
?>

<!-- 
    SENDING THE SMS
-->

<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
// To set up environmental variables, see http://twil.io/secure
$account_sid = "ACc2f96c20149fe3c1563e6164fa6ab47c"; 
$auth_token = "a36833e3cd747cc3a64a2b89c2c2a58c";

// A Twilio number you own with SMS capabilities
$twilio_number = "+16692207448";

// Create a new array with all the user's contacts numbers in the correct format for the twilio API
$numbersInTheCorrectFormat = [];

// Change the numbers into the correct format for the twilio API
foreach ($phoneNumbers as $number){
    $numbersInTheCorrectFormat[] = substr_replace($number, "+61", 0, 0);
}

print_r($numbersInTheCorrectFormat);

// Create and add the messageBodies to a array of strings
$messageBodyStrings = [];

foreach ($messages as $stringMessage){
    $messageBodyStrings[] = $stringMessage;
}

print_r($messageBodyStrings);

$i = 0;

//$sms_body = 'My name is China!';

while ($i < count($numbersInTheCorrectFormat)) {
    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        $numbersInTheCorrectFormat[$i],
        array(
            'from' => $twilio_number,
            'body' => $messageBodyStrings[$i]
        )
        );
        $i = $i + 1;
}



?>