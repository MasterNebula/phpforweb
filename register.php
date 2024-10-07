<?php
$servername = "localhost";
$username = "adhi";
$password = "pass123"; // Your MySQL password
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert into database
    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, password) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success page with user details
        header("Location: success.php?email=$email");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
