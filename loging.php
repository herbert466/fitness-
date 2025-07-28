<?php
include "connect_to_database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, email, password, user_category, username FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {s
        $row = $result->fetch_assoc();
        // Verifying the hashed password
        if (password_verify($password, $row['password'])) {
            setcookie("user", $row['email'], time() + 60 * 60 * 24 * 1);
            setcookie("user_id", $row['id'], time() + 60 * 60 * 24 * 1);
            setcookie("username", $row['username'], time() + 60 * 60 * 24 * 1);

            if ($row['user_category'] == "admin") {
                header("Location: admin_paymentverification.php");
            } else {
                header("Location: homepage.php");
            }
            exit();
        } else {
            echo "<script>alert('Wrong password or email. Try again later');</script>";
        }
    }
//success(green),secondary(gray),light(white),danger(red),warning(yellow)
    $stmt->close();
    $conn->close();
}
?>