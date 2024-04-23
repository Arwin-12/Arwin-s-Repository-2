<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oes";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data using filter_input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$confirmPassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Validate email format
$fullName = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);

// Check if form is submitted
if ($username !== null && $password !== null && $confirmPassword !== null) {
    // Check if passwords match
    if ($password === $confirmPassword) {
        // Passwords match, proceed with insertion
        $sql = "INSERT INTO registered_students (username, password, email, full_name) VALUES ('$username', '$password', '$email', '$fullName')";
        if ($conn->query($sql) === TRUE) {
            header("Location: getstarted.html");
            exit(); // Stop further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Passwords do not match'); window.location.href='http://localhost/project1/registration.html';</script>";
    }
}
?>
