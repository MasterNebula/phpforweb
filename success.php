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

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Retrieve the user details from the database
    $sql = "SELECT first_name, last_name, email, phone_number FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output user details
        $row = $result->fetch_assoc();
        echo "<h1>Welcome " . $row['first_name'] . " " . $row['last_name'] . "</h1>";
        echo "<p>Email: " . $row['email'] . "</p>";
        echo "<p>Phone Number: " . $row['phone_number'] . "</p>";
    } else {
        echo "No user found!";
    }
} else {
    echo "No email provided!";
}

$conn->close();
?>
