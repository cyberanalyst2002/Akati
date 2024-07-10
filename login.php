<?php
// Database connection parameters
$servername = "localhost";
$username = "id22392417_subiksha";
$password = "PSGpassword3*";
$dbname = "id22392417_socdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM socdb WHERE user=? AND password=?");
    $stmt->bind_param("ss", $user, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists
        session_start();
        $_SESSION['user'] = $user; // Start session and store user information if needed

        // Redirect to dashb.html
        header("Location: fetch_jira_data.php");
        exit();
    } else {
        echo "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();
?>
