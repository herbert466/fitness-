<?php
include "connect_to_database.php";
$conn = new mysqli("localhost", "root", "", "private_fitness_instructor");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Register Client
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['FirstName'])) {
    $stmt = $conn->prepare("INSERT INTO Clients (FirstName, LastName, DateOfBirth, Gender, ContactInfo, HealthConditions, FitnessGoals) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $_POST['FirstName'], $_POST['LastName'], $_POST['DateOfBirth'], $_POST['Gender'], $_POST['ContactInfo'], $_POST['HealthConditions'], $_POST['FitnessGoals']);
    $stmt->execute();
    echo "New client added successfully";
}

// Book Session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['SessionType'])) {
    $stmt = $conn->prepare("INSERT INTO Sessions (ClientID, Date, Time, Duration, SessionType, Location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississ", $_POST['ClientID'], $_POST['SessionDate'], $_POST['SessionTime'], $_POST['Duration'], $_POST['SessionType'], $_POST['Location']);
    $stmt->execute();
    echo "Session booked successfully";
}

// Make Payment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PaymentMethod'])) {
    $stmt = $conn->prepare("INSERT INTO Payments (ClientID, SessionID, PaymentDate, Amount, PaymentMethod) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $_POST['ClientID'], $_POST['SessionID'], $_POST['PaymentDate'], $_POST['Amount'], $_POST['PaymentMethod']);
    $stmt->execute();
    echo "Payment recorded successfully";
}

// User Registration
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Account already exists. Redirecting to login...');window.location.href='login.php';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            echo "<script>alert('Signed up successfully. Redirecting to login page...');window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>
?>