
<?php
// fetch_xforce_data.php

// Include the configuration file
include 'configx.php';

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, 'https://api.xforce.ibmcloud.com/url/https%3A%2F%2Fwww.akati.com%2F');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, '5f91e0b0-e74b-481f-98b2-4da4aa38c62a' . ":" . '210de489-d115-4bbe-8b5b-49336711df96');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json"
]);

// Execute cURL request
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close cURL session
curl_close($ch);

// Check response status
if ($status_code == 200) {
    $xforce_data = json_decode($response, true);
    
    // Save data to a JSON file with dynamic filename
    $json_file = 'xforce_data_' . date('YmdHis') . '.json'; // Example: xforce_data_20240704123456.json
    file_put_contents($json_file, json_encode($xforce_data, JSON_PRETTY_PRINT));
    
    echo "Data fetched and stored successfully in $json_file";
} else {
    die("Failed to fetch data: $status_code\n");
    echo "Response: $response\n";
}
?>

