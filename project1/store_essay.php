<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oes";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve essay content from the POST request
$username = $_POST['username'];
$essayContent = $_POST['essayContent'];

// SQL query to insert the username and essay content into the database
$sql = "INSERT INTO essay_exam (username, essay_content) VALUES ('$username', '$essayContent')";

if (mysqli_query($conn, $sql)) {
    // If the essay is successfully stored in the database, send a success response
    http_response_code(200);
} else {
    // If an error occurs while storing the essay in the database, send an error response
    http_response_code(500);
}

// Close the database connection
mysqli_close($conn);
?>
