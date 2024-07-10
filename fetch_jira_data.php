<?php
// fetch_jira_data.php

// Include the configuration file
include 'config.php';

// Query parameters
$query = [
    'jql' => 'project=' . 'KAN',
    'maxResults' => 1000
];

// Build the query URL
$query_url = 'https://subikshasubi3.atlassian.net/rest/api/3/search' . '?' . http_build_query($query);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $query_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic " . base64_encode('subiksha.subi3@gmail.com' . ':' . 'ATATT3xFfGF0YvNn3ii_U-FrUb4yJ-vUJMhpnRmD67YKOzyVwPHPDAjpGTVXuyOQYjXp5A6zcvhkPh--iYzv3tIA0w5A_2MEl8Y7cZkqjNyOsHNLKDA9PO3VUI3NJMJ2dI9ypKw6f0GJXnELROyfP6ERmExBUZw7hdlpFSX8xFInHvmzeo_E3mA=DBA9C7C6'),
    "Accept: application/json"
]);

// Execute cURL request
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close cURL session
curl_close($ch);

// Check response status
if ($status_code == 200) {
    $jira_data = json_decode($response, true);
    // Save data to a JSON file for easy inspection
    file_put_contents('jira_data.json', json_encode($jira_data, JSON_PRETTY_PRINT));

    // Redirect to insert_jira_data.php
    header('Location: insert_jira_data.php');
    exit; // Ensure script stops here to prevent further execution
} else {
    die("Failed to fetch data: $status_code");
}
?>
