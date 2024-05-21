<?php
// Database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "oes"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample data for demonstration, you can replace it with your own data
$questions = array(
    array("question" => "What is the capital of France?", "options" => array("Paris", "London", "Berlin", "Rome"), "correct_answer" => "Paris"),
    array("question" => "Which planet is known as the Red Planet?", "options" => array("Venus", "Mars", "Jupiter", "Saturn"), "correct_answer" => "Mars"),
    // Add more questions here
);

// Loop through each question and insert into the database
foreach ($questions as $q) {
    $question = $q['question'];
    $options = implode(",", $q['options']); // Convert options array to comma-separated string
    $correct_answer = $q['correct_answer'];

    // SQL query to insert question into the database
    $sql = "INSERT INTO questions (question, options, correct_answer) VALUES ('$question', '$options', '$correct_answer')";

    if ($conn->query($sql) === TRUE) {
        echo "Question inserted successfully.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
