<?php
// Database connection
$servername = "localhost";
$username = ""; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "oes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$full_name = "";
$email = "";
$username = "";
$password = "";

// Form validation and processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $full_name = test_input($_POST["fullname"]);
    $email = test_input($_POST["email"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm-password"]);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert user details into the database
        $sql = "INSERT INTO registered_students (full_name, email, username, password) VALUES ('$full_name', '$email', '$username', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful
            // Redirect the user to getstarted.html or any other page
            header("Location: getstarted.html");
            exit();
        } else {
            // Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close database connection
$conn->close();
?>
