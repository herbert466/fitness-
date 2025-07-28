<?php
// DB connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitness_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize inputs
$firstName = $conn->real_escape_string($_POST['FirstName']);
$lastName = $conn->real_escape_string($_POST['LastName']);
$dob = $conn->real_escape_string($_POST['DateOfBirth']);
$gender = $conn->real_escape_string($_POST['Gender']);
$contact = $conn->real_escape_string($_POST['ContactInfo']);
$health = $conn->real_escape_string($_POST['HealthConditions']);
$goals = $conn->real_escape_string($_POST['FitnessGoals']);

// SQL query to insert into `clients` table
$sql = "INSERT INTO clients (FirstName, LastName, DateOfBirth, Gender, ContactInfo, HealthConditions, FitnessGoals)
        VALUES ('$firstName', '$lastName', '$dob', '$gender', '$contact', '$health', '$goals')";

if ($conn->query($sql) === TRUE) {
  echo "Sign up successful!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
