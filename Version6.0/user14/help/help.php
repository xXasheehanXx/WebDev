<?php
//help.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is coming from a form
    
		//mysql credentials
    $mysql_host = "localhost";
    $mysql_username = "root";
    $mysql_password = "shakopeesabers";
    $mysql_database = "hallpass";
	
	//delcare PHP variables
	
	$password = $_POST["password"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$currentLocation = $_POST["currentLocation"];
	$destinationLocation = $_POST["crimecommited"];

{
	//Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
    
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}   
    
	$statement = $mysqli->prepare("INSERT INTO studentpass (firstName, lastName, currentLocation, crimecommited) VALUES(?, ?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('ssss', $firstName, $lastName, $currentLocation, $destinationLocation); //bind value
	 if($statement->execute()){
	//print output text
	echo nl2br("Hello ". $firstName ." ". $lastName . "! You reported ". $destinationLocation.  "\r\nYou have 8 minutes to stay in". $currentLocation . "\r\n", false);
	 }else{
		 print $mysqli->error; //show mysql error if any 
	 }
}
else{ 
die($passError);
}	
}			
?>