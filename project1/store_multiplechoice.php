<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "oes";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each question submitted and insert into database
    foreach ($_POST['answers'] as $question => $selected_option) {
        // Prepare SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO multiplechoice_exam (question, selected_option) VALUES (?, ?)");
        $stmt->bind_param("ss", $question, $selected_option);

        // Execute the statement
        if ($stmt->execute() === FALSE) {
            echo "Error: " . $stmt->error;
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();

    // Redirect to a thank you page or wherever you want after submitting the answers
    header("Location: getstarted.html");
    exit();
}
?>
