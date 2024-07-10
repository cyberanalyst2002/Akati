<?php
// insert_jira_data.php

// Include the configuration file
include 'config.php';

// Fetch Jira data from the JSON file
$jira_data = json_decode(file_get_contents('jira_data.json'), true);

// Database credentials from config.php
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

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO jira_issues (issue_id, status) VALUES (?, ?)");
$stmt->bind_param("ss", $issue_id, $status);

// Loop through the Jira data and insert into MySQL
foreach ($jira_data['issues'] as $issue) {
    $issue_id = $issue['id'];
    $status = $issue['fields']['status']['name'];

    $stmt->execute();
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect to dashb.html
header('Location: dashb.html');
exit; // Ensure script stops here to prevent further execution
?>
